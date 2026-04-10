<?php

namespace App\Http\Controllers;

use App\Models\Borrowing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class SiswaBorrowingController extends Controller
{
    // Lihat riwayat peminjaman
    public function riwayat()
    {
        $siswaId = Session::get('siswa_id');

        $borrowHistory = Borrowing::with('book')
            ->where('siswa_id', $siswaId)
            ->latest()
            ->get();

        return view('siswa.riwayat', compact('borrowHistory'));
    }

    // Kembalikan buku
    public function returnBook($id)
    {
        $borrowing = Borrowing::findOrFail($id);

        if ($borrowing->status === 'Dipinjam') {
            $borrowing->returnBook();
        }

        return redirect()->back()->with('success', 'Buku berhasil dikembalikan!');
    }
}
