<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EmplistDeviceModel extends Model
{
    protected $table = 'emplist_device';

    public function device()
    {
        return $this->belongsTo(DeviceModel::class, 'devId', 'id');
    }

    public function member()
    {
        return $this->belongsTo(MemberModel::class,'member_id','id');
    }
}
