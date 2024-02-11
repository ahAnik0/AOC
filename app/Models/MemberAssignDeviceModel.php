<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MemberAssignDeviceModel extends Model
{
    protected $table = 'member_assign_device';
    protected $fillable = [
        'member_id',
        'device_id',
        'card_id',
        'status',
    ];

    public function device()
    {
        return $this->belongsTo(DeviceModel::class, 'device_id', 'id');
    }

    public function member()
    {
        return $this->belongsTo(MemberModel::class,'member_id','id');
    }
}
