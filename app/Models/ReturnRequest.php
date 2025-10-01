<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ReturnRequest extends Model
{
    protected $fillable = ['borrowing_id', 'status'];

    public function borrowing()
    {
        return $this->belongsTo(Borrowing::class);
    }
}
