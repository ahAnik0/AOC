<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class rank extends Model
{
    protected $table = 'ranks';
    protected $fillable = [
        'name',
        'short_name',
    ];

    public $timestamps = false;
}
