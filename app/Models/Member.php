<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    use HasFactory;

    protected $fillable = [
        'nis',
        'name',
        'class',
        'major',
        'email'
    ];

    public function borrowings()
{
    return $this->hasMany(Borrowing::class, 'siswa_id');
}


}
