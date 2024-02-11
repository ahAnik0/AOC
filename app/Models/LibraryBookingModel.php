<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LibraryBookingModel extends Model
{
    protected $table = 'library_booking';

    public function member()
    {
        return $this->belongsTo(MemberModel::class, 'member_id', 'id');
    }

    public function book()
    {
        return $this->belongsTo(BookModel::class, 'book_id', 'id');
    }


    public function booking_details()
    {
        return $this->hasMany(BookingDetails::class, 'booking_id', 'id');
    }


}
