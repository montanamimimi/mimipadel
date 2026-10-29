<?php 

namespace App\Observers;

use App\Models\TournamentGame;
use App\Services\RatingService;
use Illuminate\Support\Facades\Log;

class TournamentGameObserver
{
    public function created(TournamentGame $game)
    {   
        Log::debug('GAME CREATED');
        app(RatingService::class)->updateForGame($game);
    }

    public function updated(TournamentGame $game)
    {        
        Log::debug('GAME UPDATED');
       app(RatingService::class)->updateForGames($game);
    }
}