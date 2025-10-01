<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use App\Models\Book;
use App\Models\Borrowing;
use App\Models\BorrowRequest;
use App\Models\ReturnRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Carbon\Carbon;

class SiswaAuthController extends Controller
{
    // Tampilkan form registrasi
    public function showRegisterForm()
    {
        return view('siswa.register');
    }

    // Proses registrasi siswa baru
    public function register(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:siswas',
            'password' => 'required|min:6'
        ]);

        $siswa = Siswa::create([
            'nama' => $validated['name'], // Changed from 'name' to 'nama'
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
        ]);

        // Langsung set session setelah register berhasil
        session([
            'is_siswa_logged_in' => true,
            'siswa_nama' => $siswa->nama,
            'siswa_id' => $siswa->id
        ]);

        return redirect('/siswa/dashboard')->with('success', 'Selamat datang di Perpustakaan Digital!');
    }

    // Tampilkan form login
    public function showLoginForm()
    {
        return view('siswa.login');
    }

    // Proses login siswa
    public function login(Request $request)
    {
        $siswa = Siswa::where('email', $request->email)->first();

        if ($siswa && Hash::check($request->password, $siswa->password)) {
            // Set session login
            $request->session()->put('is_siswa_logged_in', true);
            $request->session()->put('siswa_nama', $siswa->nama);
            $request->session()->put('siswa_id', $siswa->id);
            return redirect('/siswa/dashboard');
        }

        return back()->with('error', 'Email atau password salah');
    }

    // Halaman dashboard siswa
    public function dashboard(Request $request)
    {
        if (!Session::get('is_siswa_logged_in')) {
            return redirect('/siswa/login')->with('error', 'Silakan login dahulu');
        }

        $siswa_id = Session::get('siswa_id');

        // Get active borrowings and pending requests
        $activeBorrowings = Borrowing::where('siswa_id', $siswa_id)
            ->where('status', 'approved')
            ->count();

        $pendingRequests = BorrowRequest::where('siswa_id', $siswa_id)
            ->where('status', 'pending')
            ->count();

        // Total current borrowings including pending requests
        $totalCurrentBorrowings = $activeBorrowings + $pendingRequests;

        // Get nearest due date from active borrowings
        $nearestBorrowing = Borrowing::where('siswa_id', $siswa_id)
            ->where('status', 'Dipinjam')
            ->whereNull('return_date')  // Only get unreturned books
            ->orderBy('due_date', 'asc')
            ->first();

        // Calculate days until due date
        $nearestDueDate = null;
        if ($nearestBorrowing && $nearestBorrowing->due_date) {
            $dueDate = Carbon::parse($nearestBorrowing->due_date);
            $today = Carbon::now();
            if ($today->gt($dueDate)) {
                // Book is overdue
                $nearestDueDate = -$today->diffInDays($dueDate); // Negative number for overdue
            } else {
                // Days remaining
                $nearestDueDate = $today->diffInDays($dueDate);
            }
        }

        $totalBorrowings = 0;
        $totalFines = 0;

        if ($siswa_id) {
            // Total peminjaman (semua status)
            $totalBorrowings = Borrowing::where('siswa_id', $siswa_id)->count();

            // Hitung total denda (simulasi, contoh denda 1000 per hari keterlambatan)
            $lateBorrowings = Borrowing::where('siswa_id', $siswa_id)
                ->where('status', 'approved')
                ->whereDate('return_date', '<', now())
                ->get();

            foreach ($lateBorrowings as $late) {
                $daysLate = Carbon::parse($late->return_date)->diffInDays(Carbon::now());
                $totalFines += $daysLate * 1000;
            }
        }

        // Ambil kategori buku unik
        $categories = Book::distinct('category')->pluck('category');
        $query = Book::query();

        // Filter pencarian judul atau pengarang
        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                    ->orWhere('author', 'like', "%{$search}%");
            });
        }

        // Filter kategori
        if ($request->has('category') && $request->category != '') {
            $query->where('category', $request->category);
        }

        $books = $query->paginate(12);
        $nama = Session::get('siswa_nama');

        // Get borrowing history
        $borrowHistory = Borrowing::with('book')
            ->where('siswa_id', $siswa_id)
            ->orderBy('created_at', 'desc')
            ->get();

        return view('siswa.dashboard', compact(
            'books',
            'categories',
            'nama',
            'totalCurrentBorrowings',
            'nearestDueDate',
            'totalBorrowings',
            'totalFines',
            'borrowHistory'
        ));
    }

    // Proses request pinjam buku
    public function borrow(Request $request, $bookId)
    {
        if (!$request->session()->get('is_siswa_logged_in')) {
            return redirect('/siswa/login')->with('error', 'Silakan login dahulu');
        }

        $siswaId = $request->session()->get('siswa_id');
        if (!$siswaId) {
            return redirect('/siswa/login')->with('error', 'Sesi tidak valid');
        }

        $book = Book::findOrFail($bookId);

        if ($book->stock <= 0) {
            return back()->with('error', 'Buku tidak tersedia untuk dipinjam');
        }

        // Cek apakah sudah ada request pinjam yang pending untuk buku ini
        $existingRequest = BorrowRequest::where('siswa_id', $siswaId)
            ->where('book_id', $bookId)
            ->where('status', 'pending')
            ->first();

        if ($existingRequest) {
            return back()->with('error', 'Anda sudah memiliki permintaan peminjaman yang menunggu untuk buku ini');
        }

        // Buat request peminjaman baru
        BorrowRequest::create([
            'siswa_id' => $siswaId,
            'book_id' => $book->id,
            'status' => 'pending'
        ]);

        return redirect()->back()->with('success', 'Permintaan peminjaman buku telah dikirim ke admin');
    }

    // Logout siswa
    public function logout()
    {
        Session::forget('is_siswa_logged_in');
        Session::forget('siswa_nama');
        Session::forget('siswa_id');
        return redirect('/siswa/login');
    }

    // Menampilkan detail buku
    public function showBook($id)
    {
        $book = Book::findOrFail($id);
        return view('siswa.books.show', compact('book'));
    }

    public function riwayat()
    {
        if (!Session::get('is_siswa_logged_in')) {
            return redirect('/siswa/login')->with('error', 'Silakan login dahulu');
        }

        $siswa_id = Session::get('siswa_id');
        
        // Get borrowing history with status
        $borrowHistory = Borrowing::with('book')
            ->where('siswa_id', $siswa_id)
            ->orderBy('created_at', 'desc')
            ->get()
            ->map(function($borrowing) {
                $borrowing->status_display = $this->getStatusDisplay($borrowing);
                return $borrowing;
            });

        return view('siswa.riwayat', [
            'borrowHistory' => $borrowHistory,
            'nama' => Session::get('siswa_nama'),
        ]);
    }

    protected function getStatusDisplay($borrowing)
    {
        if ($borrowing->status === 'Dipinjam') {
            if (Carbon::now()->gt($borrowing->due_date)) {
                return ['text' => 'Terlambat', 'class' => 'danger'];
            }
            return ['text' => 'Sedang Dipinjam', 'class' => 'warning'];
        }
        
        if ($borrowing->status === 'Pending Return') {
            return ['text' => 'Menunggu Konfirmasi Pengembalian', 'class' => 'info'];
        }
        
        if ($borrowing->status === 'Dikembalikan') {
            return ['text' => 'Sudah Dikembalikan', 'class' => 'success'];
        }

        return ['text' => $borrowing->status, 'class' => 'secondary'];
    }

    public function requestReturn(Borrowing $borrowing)
    {
        if ($borrowing->siswa_id !== Session::get('siswa_id')) {
            return back()->with('error', 'Unauthorized action');
        }

        if ($borrowing->status !== 'Dipinjam') {
            return back()->with('error', 'Buku ini tidak dalam status dipinjam');
        }

        $borrowing->update([
            'status' => 'Pending Return'
        ]);

        return back()->with('success', 'Permintaan pengembalian telah diajukan. Silahkan tunggu konfirmasi admin.');
    }

    
}

