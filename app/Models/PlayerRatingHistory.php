<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUlids;

class PlayerRatingHistory extends Model
{    

    protected $table = 'player_rating_history';
    public $incrementing = false;
    protected $keyType = 'string';
    use HasUlids;
    
    protected $fillable = [
        'id',
        'tournament_id',
        'player_id',
        'tournament_game_id',
        'old_rating',
        'rating_change',
        'new_rating',
    ];

}
