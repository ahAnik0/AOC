<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdditionalCharge extends Model
{
   
    protected $table = 'hall_booking_charge';
    protected $fillable = [
        
        'booking_id',
        'hall_rent',
        'hall_vat',
        'current_bill',
        'cookeries_bill',
        'cook_house_bill',
        'event_charge',
        'event_vat',
        'catering_bill',
        'catering_bill_vat',
        'damage_bill',
        'total'
    ];

    public function hallbooking()
    {
        return $this->belongsTo(HallBookingModel::class,'booking_id','id');
    }
}
