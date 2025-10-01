<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Borrowing;
use App\Models\Siswa;
use Illuminate\Support\Facades\DB;
use App\Models\BorrowRequest;
use App\Models\Member;

class TransactionController extends Controller
{
    public function index(Request $request)
    {
        // Ambil semua transaksi dengan relasi siswa & buku
        $query = Borrowing::with(['siswa', 'book']);

        // Filter status (jika dikirim lewat URL)
        if ($request->status) {
            $query->where('status', $request->status);
        }

        // Ambil transaksi terbaru
        $transactions = $query->orderBy('created_at', 'desc')->get();

        // Ambil semua siswa yang sudah meminjam
        $borrowedSiswaIds = $transactions->pluck('siswa_id')->unique()->toArray();

        // Ambil siswa yang belum meminjam
        $availableSiswa = Siswa::whereNotIn('id', $borrowedSiswaIds)->pluck('nama', 'id');

        // Kirim ke view
        return view('admin.transactions.index', compact('transactions', 'availableSiswa'));
    }

    public function return($id)
    {
        $transaction = Borrowing::findOrFail($id);
        $transaction->update([
            'status' => 'returned',
            'return_date' => now()
        ]);

        // Tambah stok buku kembali
        $transaction->book->increment('stock');

        return redirect()->back()->with('success', 'Buku berhasil dikembalikan');
    }
    public function store(Request $request)
{
    $request->validate([
        'siswa_id' => 'required|exists:siswas,id',
        'book_id' => 'required|exists:books,id',
        'borrow_date' => 'required|date',
        'return_date' => 'nullable|date|after_or_equal:borrow_date',
    ]);

    Borrowing::create([
        'siswa_id' => $request->siswa_id,
        'book_id' => $request->book_id,
        'borrow_date' => $request->borrow_date,
        'return_date' => $request->return_date,
        'status' => 'approved'
    ]);

    return redirect()->route('admin.transactions.index')->with('success', 'Peminjaman berhasil ditambahkan.');
}

public function approve($id)
{
    $request = BorrowRequest::findOrFail($id);

    // Buat member baru kalau belum ada
    $member = Member::firstOrCreate(
        ['email' => $request->siswa->email],
        [
            'nis'   => $request->siswa->nis ?? 'AUTO' . $request->siswa->id,
            'name'  => $request->siswa->nama,
            'class' => $request->siswa->class ?? '-',
            'major' => $request->siswa->major ?? '-',
        ]
    );

    // Update status request jadi disetujui
    $request->update(['status' => 'approved']);

    return redirect()->back()->with('success', 'Peminjaman disetujui dan siswa masuk ke Members');
}

}
