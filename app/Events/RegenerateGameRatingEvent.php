<?php

namespace App\Events;

use App\Models\TournamentGame;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class RegenerateGameRatingEvent
{
    use Dispatchable, SerializesModels;

    public function __construct(
        public TournamentGame $game
    ) {}
}