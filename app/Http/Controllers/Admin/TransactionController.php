<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Borrowing;
use App\Models\Siswa;
use Illuminate\Support\Facades\DB;
use App\Models\BorrowRequest;
use App\Models\Member;
use App\Models\Transaction;
use Illuminate\Support\Facades\Auth;    


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
    public function store(Request $request, $bukuId)
{
    $request->validate([
        'tanggal_jatuh_tempo' => 'required|date|after_or_equal:today',
    ]);

    Transaction::create([
          'siswa_id' => Auth::id(), // ✅
        'buku_id' => $bukuId,
        'tanggal_pinjam' => now(),
        'tanggal_jatuh_tempo' => $request->tanggal_jatuh_tempo,
        'status' => 'Sedang Dipinjam',
    ]);

    return redirect()->route('siswa.riwayat')->with('success', 'Buku berhasil dipinjam!');
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


public function returnBook($id)
{
    $borrowing = Borrowing::where('id', $id)
        ->where('siswa_id', Auth::id()) // ✅ lebih aman utk Intelephense
        ->firstOrFail();

    if ($borrowing->status === 'Sedang Dipinjam') {
        $borrowing->update([
            'status' => 'Returned',
            'tanggal_dikembalikan' => now(),
        ]);
    }

    return redirect()->route('siswa.riwayat')
        ->with('success', 'Buku berhasil dikembalikan!');
}




}
