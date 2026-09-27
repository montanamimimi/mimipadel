<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUlids;

class TournamentGame extends Model
{    

    public $incrementing = false;
    protected $keyType = 'string';  
    use HasUlids;  
    
    protected $fillable = [
        'id',
        'tournament_id',
        'round',
        'side1_player1_id',
        'side1_player2_id',
        'side2_player1_id',
        'side2_player2_id',
        'side_1_score',
        'side_2_score'
    ];

}
