<?php 

namespace App\Observers;

use App\Models\TournamentGame;
use App\Services\RatingService;
use Illuminate\Support\Facades\Log;

class TournamentGameObserver
{
    public function created(TournamentGame $game)
    {   
        app(RatingService::class)->updateForGame($game);
    }

    public function updated(TournamentGame $game)
    {        
       app(RatingService::class)->updateForGames($game);
    }
}