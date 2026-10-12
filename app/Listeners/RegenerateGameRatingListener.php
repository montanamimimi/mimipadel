<?php

namespace App\Listeners;

use App\Events\RegenerateGameRatingEvent;
use App\Services\RatingService;

class RegenerateGameRatingListener
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(RegeneRateGameratingEvent $event): void
    {
        app(RatingService::class)->updateForGame($event->game);
    }
}
