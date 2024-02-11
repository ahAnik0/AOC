<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class service extends Model
{
    protected $table = 'services';

    public function member()
    {
        return $this->belongsTo(MemberModel::class,'member_id','id');
    }
}
