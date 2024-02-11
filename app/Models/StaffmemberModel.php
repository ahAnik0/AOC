<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StaffmemberModel extends Model
{
    protected $table = 'staff_member';
    protected $fillable = [
        'name',
//        'card_number',
        'nid',
        'dob',
        'appointment',
        'issue_date',
        'expire_date',
        'photo',
        'signature',
        'rfid',
        'privilege',
        'phone',
        'address',
        'status',
    ];

//    public $timestamps = false;
}
