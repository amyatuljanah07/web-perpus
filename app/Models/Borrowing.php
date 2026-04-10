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
    'borrow_date' => 'datetime',
    'return_date' => 'datetime',
    'due_date' => 'datetime',
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

    // Hitung denda (Rp 5000 per hari telat)
    public function calculateFine()
    {
        if ($this->status === 'Dipinjam' && $this->due_date && Carbon::now()->gt($this->due_date)) {
          $daysLate = Carbon::parse($this->due_date)->diffInDays(Carbon::now());
            return $daysLate * 5000;
        }
        return 0;
    }

    // Update saat buku dikembalikan
    public function returnBook()
    {
        $this->status = 'Dikembalikan';
        $this->return_date = Carbon::now();
        $this->fine = $this->calculateFine();
        $this->save();
        
        // Kembalikan stok buku
        $this->book->increment('stock');
        
        return true;
    }

    // Status helper
    public function isPending()
    {
        return $this->status === 'Pending Return';
    }

    public function isOverdue()
    {
        return $this->status === 'Dipinjam' && $this->due_date && Carbon::now()->gt($this->due_date);
    }

    public function isBorrowed()
    {
        return $this->status === 'Dipinjam';
    }

    // Status untuk Blade
    public function getStatusDisplayAttribute()
{
    if ($this->isOverdue()) {
        return [
            'text'  => 'Terlambat',
            'class' => 'danger'
        ];
    }

    switch ($this->status) {
        case 'Dipinjam':
            return ['text' => 'Sedang Dipinjam', 'class' => 'primary'];
        case 'Pending Return':
            return ['text' => 'Menunggu Konfirmasi', 'class' => 'warning'];
        case 'Dikembalikan':
            return ['text' => 'Sudah Dikembalikan', 'class' => 'success'];
        default:
            return ['text' => $this->status, 'class' => 'secondary'];
    }
}

}
