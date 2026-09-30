<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\TournamentGame;
use App\Observers\TournamentGameObserver;

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
    }
}
