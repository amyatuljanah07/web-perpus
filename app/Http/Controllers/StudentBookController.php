<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Book;
use App\Models\Borrowing;
use Illuminate\Http\Request;

class StudentBookController extends Controller
{
    public function borrow(Request $request, $id)
    {
        $book = Book::findOrFail($id);
        $siswa = auth()->guard('siswa')->user();

        // Check if book is available
        if ($book->stock <= 0) {
            return redirect()->back()->with('error', 'Buku tidak tersedia');
        }

        // Create borrowing record
        $borrowing = Borrowing::create([
            'siswa_id' => $siswa->id,
            'book_id' => $book->id,
            'borrow_date' => Carbon::now(),
            'due_date' => Carbon::now()->addDays(5),
            'status' => 'Dipinjam',
            'fine' => 0
        ]);

        // Update book stock
        $book->decrement('stock');

        return redirect()->back()->with('success', 'Buku berhasil dipinjam. Harap kembalikan dalam 5 hari.');
    }

    public function calculateFine(Borrowing $borrowing)
    {
        if (!$borrowing->return_date && Carbon::now()->gt($borrowing->due_date)) {
            $daysLate = Carbon::now()->diffInDays($borrowing->due_date);
            return $daysLate * 5000; // Rp 5.000 per hari
        }
        return 0;
    }
}
