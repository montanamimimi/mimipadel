<?php 

namespace App\Observers;

use App\Models\Player;
use App\Services\RatingService;
use Illuminate\Support\Facades\Log;

class PlayerObserver
{
    public function created(Player $player)
    {   
        app(RatingService::class)->createFirstRating($player);
    }
}