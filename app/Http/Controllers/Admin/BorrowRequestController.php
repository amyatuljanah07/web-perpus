<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BorrowRequest;
use App\Models\Borrowing;
use App\Models\Member;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BorrowRequestController extends Controller
{
    public function approve($id)
    {
        try {
            DB::transaction(function () use ($id) {
                $req = BorrowRequest::with('siswa','book')->findOrFail($id);
                $siswa = $req->siswa;
                $book  = $req->book;

                // Pastikan stok cukup
                if (!$book || $book->stock <= 0) {
                    throw new \Exception('Buku tidak tersedia (stok habis).');
                }

                // Tambahkan ke members jika belum ada
                // Gunakan email sebagai unique key (atau nis jika ada)
                $member = Member::firstOrCreate(
                    ['email' => $siswa->email],
                    [
                        'nis'   => $siswa->nis ?? 'AUTO'.str_pad($siswa->id,5,'0',STR_PAD_LEFT),
                        'name'  => $siswa->nama ?? $siswa->name ?? '-',
                        'class' => $siswa->class ?? '-',
                        'major' => $siswa->major ?? '-',
                    ]
                );

                // Buat record Borrowing
                Borrowing::create([
                    'siswa_id'    => $siswa->id,
                    'book_id'     => $book->id,
                    'status'      => 'Dipinjam',
                    'borrow_date' => now(),
                    'due_date'    => now()->addDays(7), // atur sesuai kebijakan
                ]);

                // Kurangi stok buku
                $book->decrement('stock', 1);

                // Update status request
                $req->update(['status' => 'approved']);
            });

            return redirect()->back()->with('success', 'Permintaan disetujui dan siswa ditambahkan ke Members (jika belum ada).');

        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal menyetujui: '.$e->getMessage());
        }
    }
    public function reject($id)
    {
        $req = BorrowRequest::findOrFail($id);
        $req->update(['status' => 'rejected']);

        return redirect()->back()->with('success', 'Permintaan ditolak.');
    }
}
