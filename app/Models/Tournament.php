<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tournament extends Model
{
    protected $fillable = [        
        'id',
        'user_id',
        'name',
        'date',
        'format',
        'courts',
        'points',
        'started',
        'finished',
        'mixer',
    ];
}
