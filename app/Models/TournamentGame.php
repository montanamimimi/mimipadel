<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use App\Models\Tournament;
use App\Models\Player;

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

    public function tournament()
    {
        return $this->belongsTo(Tournament::class);
    }

    public function side1Player1()
    {
        return $this->belongsTo(TournamentPlayer::class, 'side1_player1_id');
    }

    public function side1Player2()
    {
        return $this->belongsTo(TournamentPlayer::class, 'side1_player2_id');
    }

    public function side2Player1()
    {
        return $this->belongsTo(TournamentPlayer::class, 'side2_player1_id');
    }

    public function side2Player2()
    {
        return $this->belongsTo(TournamentPlayer::class, 'side2_player2_id');
    }    

    public function playerRatings()
    {
        return $this->hasMany(PlayerRatingHistory::class, 'tournament_game_id');
    }    
}
