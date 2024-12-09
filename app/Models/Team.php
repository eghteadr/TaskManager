<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    /** @use HasFactory<\Database\Factories\TeamFactory> */
    use HasFactory;

    protected $table = 'teams';

    protected $fillable = [
        'user_id',
        'supervisor_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
