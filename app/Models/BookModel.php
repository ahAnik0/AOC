<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookModel extends Model
{
    protected $table = 'books';
    protected $fillable = [
        'book_name',
        'book_author',
        'price',
        'buy_price',
        'status',
        'quantity',
    ];
}
