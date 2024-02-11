<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MovieBookingModel extends Model
{
    protected $table = 'movie_booking';

    public function movie()
    {
        return $this->belongsTo(MovieModel::class, 'movie_id', 'id');
    }

    public function member()
    {
        return $this->belongsTo(MemberModel::class, 'member_id', 'id');
    }

    public function seat()
    {
        return $this->hasMany(SeatBookedModel::class, 'bokking_id', 'id');
    }
}
