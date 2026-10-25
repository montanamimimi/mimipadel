<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TournamentPlayer extends Model
{    

    public $incrementing = false;
    protected $keyType = 'string';    
    use HasUlids;
    
    protected $fillable = [
        'id',
        'tournament_id',
        'player_id',
        'name',        
    ];

    public function player(): BelongsTo
    {
        return $this->belongsTo(Player::class);
    }    

}
