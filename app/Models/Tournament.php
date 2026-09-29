<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUlids;

class Tournament extends Model
{
    public $incrementing = false;
    protected $keyType = 'string'; 
    use HasUlids;  
    
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

    protected $casts = [
        'finished' => 'boolean',
    ];    
}
