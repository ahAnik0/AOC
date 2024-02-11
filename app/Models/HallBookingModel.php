<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HallBookingModel extends Model
{
    protected $table = 'hall_booking_new';
    protected $fillable = [
        'title',
        'member_id',
        'date',
        'hall',
        'status',
        'amount',
        'due_amount',
        'details',
        'color',
        'mobile',
        'shift',
        'duration',
        'pay_type'
    ];

    public function member()
    {
        return $this->belongsTo(MemberModel::class,'member_id','id');
    }
}
