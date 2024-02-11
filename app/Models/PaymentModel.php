<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PaymentModel extends Model
{
    protected $table = 'payments';
//    protected $fillable = [
//        'title',
//        'start_date',
//        'end_date',
//        'show_time',
//        'video_link',
//        'poster',
//        'image',
//        'desc',
//    ];


    public function member()
    {
        return $this->belongsTo(MemberModel::class,'member_id','id');
    }
}
