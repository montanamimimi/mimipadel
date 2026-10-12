<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use App\Services\RatingService;
use App\Models\PlayerRatingHistory;
use App\Models\TournamentGame;
use App\Events\RegeneRateGameratingEvent;

class UpdateRatings extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'update:ratings';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update all user ratings';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        
        PlayerRatingHistory::whereNotNull('tournament_id')
        ->delete();

        $games = TournamentGame::orderBy('created_at')
        ->get();

        foreach ($games as $game) {
            RegeneRateGameratingEvent::dispatch($game);
        }

        Log::info('Ratings regenerared for ' . count($games) . ' games');
    }
}
