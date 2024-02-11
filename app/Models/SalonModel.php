<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SalonModel extends Model
{
    protected $table = 'barber_shop';

    public function member()
    {
        return $this->belongsTo(MemberModel::class,'member_id','id');
    }
}
