<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $fillable = [
        'title',
        'author', 
        'category',
        'genre',
        'pages',
        'status',
        'year',
        'stock',
        'synopsis',
        'cover_url'
    ];

  

}
