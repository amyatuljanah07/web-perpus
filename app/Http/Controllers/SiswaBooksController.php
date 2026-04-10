<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\BorrowRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Carbon\Carbon;

class SiswaBooksController extends Controller
{
    public function show($id)
    {
        $book = Book::findOrFail($id);
        return view('siswa.books.show', compact('book'));
    }

    public function borrow(Request $request, $id)
    {
        $siswaId = Session::get('siswa_id');
        if (!$siswaId) {
            return redirect('/siswa/login')->with('error', 'Silakan login dahulu');
        }
        
           $request->validate([
        'borrow_date' => 'required|date',
        'due_date'    => 'required|date|after_or_equal:borrow_date',
    ]);
        try {
            $book = Book::findOrFail($id);
            
            if ($book->stock <= 0) {
                return back()->with('error', 'Stok buku tidak tersedia');
            }

            // Cek apakah sudah ada permintaan pending
            $existingRequest = BorrowRequest::where('siswa_id', $siswaId)
                ->where('book_id', $id)
                ->where('status', 'pending')
                ->first();

            if ($existingRequest) {
                return back()->with('error', 'Anda sudah memiliki permintaan peminjaman yang pending untuk buku ini');
            }

            // Buat permintaan peminjaman baru
            BorrowRequest::create([
                'siswa_id' => $siswaId,
                'book_id' => $id,
                'status' => 'pending'
            ]);

            return back()->with('success', 'Permintaan peminjaman berhasil diajukan');

        } catch (\Exception $e) {
            Log::error('Gagal mengajukan permintaan peminjaman: ' . $e->getMessage());
            return back()->with('error', 'Terjadi kesalahan saat mengajukan permintaan');
        }
    }
}
