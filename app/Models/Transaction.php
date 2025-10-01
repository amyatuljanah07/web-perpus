<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $fillable = [
        'user_id', 'book_id', 'status', 'borrowed_at',
        'due_date', 'returned_at', 'fine'
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function book() {
        return $this->belongsTo(Book::class);
    }
}
