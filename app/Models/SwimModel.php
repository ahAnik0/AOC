<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SwimModel extends Model
{
    protected $table = 'swim';

    public function member()
    {
        return $this->belongsTo(MemberModel::class,'member_id','id');
    }
}
