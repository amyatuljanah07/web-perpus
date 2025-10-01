<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use App\Models\Siswa;
use App\Models\Book;
use App\Models\ReturnRequest;

class Borrowing extends Model
{
    protected $table = 'borrowings';

    protected $fillable = [
        'siswa_id',
        'book_id',
        'status', 
        'borrow_date',
        'return_date',
        'notes',
        'due_date',
        'fine'
    ];

    protected $casts = [
        'borrow_date' => 'date',
        'return_date' => 'date'
    ];

    protected $dates = [
        'borrow_date',
        'due_date',
        'return_date'
    ];

    public function siswa()
    {
        return $this->belongsTo(Siswa::class);
    }

    public function book()
    {
        return $this->belongsTo(Book::class);
    }

    public function returnRequest()
    {
        return $this->hasOne(ReturnRequest::class);
    }

    public function calculateFine()
    {
        if ($this->status === 'Dipinjam' && Carbon::now()->gt($this->due_date)) {
            $daysLate = Carbon::now()->diffInDays($this->due_date);
            return $daysLate * 5000; // Rp 5.000 per hari
        }
        return 0;
    }

    public function returnBook()
    {
        $this->status = 'Dikembalikan';
        $this->return_date = Carbon::now();
        $this->fine = $this->calculateFine();
        $this->save();
        
        // Increment book stock
        $this->book->increment('stock');
        
        return true;
    }

    public function isPending()
    {
        return $this->status === 'Pending Return';
    }

    public function isOverdue()
    {
        return $this->status === 'Dipinjam' && Carbon::now()->gt($this->due_date);
    }

    public function isBorrowed()
    {
        return $this->status === 'Dipinjam';
    }

    public function getStatusDisplay()
    {
        if ($this->isOverdue()) {
            return 'Terlambat';
        }
        
        switch ($this->status) {
            case 'Dipinjam':
                return 'Sedang Dipinjam';
            case 'Pending Return':
                return 'Menunggu Konfirmasi';
            case 'Dikembalikan':
                return 'Sudah Dikembalikan';
            default:
                return $this->status;
        }
    }
}
