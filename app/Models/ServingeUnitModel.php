<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServingeUnitModel extends Model
{
    protected $table = 'serving_unit';
    protected $fillable = [
        'name',
        'status',
    ];

    public $timestamps = false;
}
