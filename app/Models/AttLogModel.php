<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AttLogModel extends Model
{
    protected $table = 'attlog';
    protected $fillable = [
        'device_id', 'badge_number',
        'authDateTime',
        'authDate',
        'authTime',
        'purpose',
        'created_at',
        'updated_at',
    ];

    public function member()
    {
        return $this->belongsTo(MemberModel::class, 'member_id', 'id');
    }

    public function device()
    {
        return $this->belongsTo(DeviceModel::class, 'device_id', 'id');
    }
}
