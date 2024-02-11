<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NoticeInfo extends Model
{
    use HasFactory;
    
    protected $table = 'notice_infos';
    protected $fillable = [
        'title',
        'pdf',
        'type',
        'date'
    ];
}
