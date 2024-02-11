<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MovieModel extends Model
{
    protected $table = 'movie';
    protected $fillable = [
        'title',
        'start_date',
        'end_date',
        'show_time',
        'video_link',
        'poster',
        'image',
        'desc',
    ];
}
