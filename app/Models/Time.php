<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Time extends Model
{
    protected $table = 'task_times';
    protected $fillable = [
        'user_id',
        'time',
        'project_id'
    ];
}
