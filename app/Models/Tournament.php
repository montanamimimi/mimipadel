<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tournament extends Model
{
    public $incrementing = false;
    protected $keyType = 'string';    
    
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
