<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class MemberModel extends Authenticatable
{
    use Notifiable;
    protected $table = 'members';
        /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'member_id', 'member_id_inputed', 'email','password'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function designation()
    {
        return $this->belongsTo(rank::class,'designation_id','id');
    }

    public function blood_group()
    {
        return $this->belongsTo(BloodGroupModel::class,'blood_group_id','id');
    }

    public function relationship()
    {
        return $this->belongsTo(RelationshipModel::class,'relationship_id','id');
    }

    public function parent_member()
    {
        return $this->belongsTo(MemberModel::class,'parent_member_id','id');
    }

    public function payment_history()
    {
        return $this->hasMany(PaymentModel::class,'member_id','id_payment_key');
    }

}


