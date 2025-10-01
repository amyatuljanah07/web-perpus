<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BorrowRequest extends Model
{
    protected $fillable = [
        'siswa_id',
        'book_id',
        'status',
        'note'
    ];
    protected $guarded = [];

    public function siswa()
    {
        return $this->belongsTo(Siswa::class);
    }

    public function book()
    {
        return $this->belongsTo(Book::class);
    }
}
