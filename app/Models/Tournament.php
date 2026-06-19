<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tournament extends Model
{
    protected $fillable = [
        'name',
        'date',
        'courts',
        'players',
        'games',
        'finished',
    ];

    protected $attributes = [
        'players' => '[]',
        'games' => '[]',
    ];    
}
