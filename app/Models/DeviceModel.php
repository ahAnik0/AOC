<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DeviceModel extends Model
{
    protected $table = 'device_name';
    protected $fillable = [
        'device_name',
        'device_id',
        'device_number',
        'device_ip',
        'status',
    ];
}
