<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookingDetails extends Model
{
    protected $table = 'library_booking_details';

    public function book_details()
    {
        return $this->belongsTo(BookModel::class, 'book_id', 'id');
    }
}
