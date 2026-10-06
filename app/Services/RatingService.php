<?php

namespace App\Services;

use App\Models\TournamentGame;
use App\Models\TournamentPlayer;
use App\Models\PlayerRatingHistory;
use Illuminate\Support\Facades\Log;

class RatingService
{

    public function updateForGame(TournamentGame $game): void
    {

        $tournamentPlayer1 = TournamentPlayer::with('player')
        ->findOrFail($game->side1_player1_id);
        $tournamentPlayer2 = TournamentPlayer::with('player')
        ->findOrFail($game->side1_player2_id);
        $tournamentPlayer3 = TournamentPlayer::with('player')
        ->findOrFail($game->side2_player1_id);
        $tournamentPlayer4 = TournamentPlayer::with('player')
        ->findOrFail($game->side2_player2_id);                               

        $rating = $this->calculate(
            $tournamentPlayer1->player->latestRating->new_rating,
            $tournamentPlayer2->player->latestRating->new_rating,
            $tournamentPlayer3->player->latestRating->new_rating,
            $tournamentPlayer4->player->latestRating->new_rating,
            $game->side_1_score,
            $game->side_2_score,
        );

        $players = [
            [$tournamentPlayer1, $rating],
            [$tournamentPlayer2, $rating],
            [$tournamentPlayer3, -$rating],
            [$tournamentPlayer4, -$rating],
        ];

        foreach ($players as [$tournamentPlayer, $ratingChange]) {
            $oldRating = $tournamentPlayer->player->latestRating->new_rating;

            PlayerRatingHistory::create([
                'tournament_id' => $game->tournament_id,
                'player_id' => $tournamentPlayer->player_id,
                'tournament_game_id' => $game->id,
                'old_rating' => $oldRating,
                'rating_change' => $ratingChange,
                'new_rating' => $oldRating + $ratingChange,
            ]);
        }             

    }

    public function updateForGames(TournamentGame $game): void
    {
        $history = PlayerRatingHistory::where(
            'tournament_game_id',
            $game->id
        )->first();

        if ($history) {
            PlayerRatingHistory::where(
                'created_at',
                '>=',
                $history->created_at
            )
            ->whereNotNull('tournament_id')
            ->delete();
        }

        $after = TournamentGame::where(
            'created_at',
            '>=',
            $game->created_at
        )
        ->orderBy('created_at')
        ->get();

        Log::debug(count($after));

        foreach ($after as $game) {
            $this->updateForGame($game);
        }
    }

    public function calculate(
        int $ratingA,
        int $ratingB,
        int $ratingC,
        int $ratingD,      
        int $scoreA,
        int $scoreB,
        )
    {
        $teamA = $this->getTeamScore($ratingA, $ratingB);
        $teamB = $this->getTeamScore($ratingC, $ratingD);

        $expected = $this->getExpectedScore($teamA, $teamB);

        $k = 12;

        if ($scoreA > $scoreB) {
            $eloK = 1;
        } else if ($scoreA < $scoreB) {
            $eloK = 0;
        } else {
            $eloK = 0.5;
        }

        $eloChange = $k * ($eloK - $expected);
        $scoreFactor = abs($scoreA - $scoreB)/($scoreA + $scoreB);

        $multiplier = 1 + $scoreFactor;
        $change = round($eloChange * $multiplier);

        return $change;
    }

    private function getExpectedScore(int $a, int $b) {

        $exponent = ($b - $a)/400;
        $pow = pow(10, $exponent);
        $expected = 1/(1+$pow);

        return round($expected, 4);

    }

    private function getTeamScore(int $a, int $b) {
        return round(($a + $b)/2);
    }    
}