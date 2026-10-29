<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\TournamentGame;
use App\Models\Player;
use App\Observers\TournamentGameObserver;
use App\Observers\PlayerObserver;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        TournamentGame::observe(TournamentGameObserver::class);
        Player::observe(PlayerObserver::class);
    }
}
