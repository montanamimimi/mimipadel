<?php 

namespace App\Livewire\Tournaments;

use Livewire\Component;
use App\Models\Tournament;
use App\Models\TournamentPlayer;
use App\Models\TournamentGame;

class BaseTournamentPage extends Component
{
    public ?Tournament $tournament = null;
    
    public $tournamentPlayers;
    public $tournamentGames;
    public $leaderboard = [];
    public $finished;

    public string $mode = 'view';

    public function mount(?Tournament $tournament = null)
    {   
       
        $this->tournament = $tournament;

        if (!$tournament) {
            $this->mode = 'create';
        } else {           
            $this->finished = $this->tournament->finished;

            $this->tournamentPlayers = TournamentPlayer::with('player')
            ->where('tournament_id', $tournament->id)
            ->orderBy('name')
            ->get();

            $this->tournamentGames = TournamentGame::where('tournament_id', $tournament->id)->get();

            $this->populateLeaderboard();        

        }

    }

    protected function populateLeaderboard() {

        $arr = [];
        $this->leaderboard = [];

        foreach ($this->tournamentPlayers as $player) {
            $arr[$player->id] = [
                'score' => 0,
                'win' => 0,
                'tie' => 0,
                'loss' => 0,
            ];
        }        

        foreach ($this->tournamentGames as $game) {
            $arr[$game->side1_player1_id]['score'] += $game->side_1_score;
            $arr[$game->side1_player2_id]['score'] += $game->side_1_score;
            $arr[$game->side2_player1_id]['score'] += $game->side_2_score;
            $arr[$game->side2_player2_id]['score'] += $game->side_2_score;

            if ($game->side_1_score > $game->side_2_score) {
                $arr[$game->side1_player1_id]['win'] += 1;
                $arr[$game->side1_player2_id]['win'] += 1;
                $arr[$game->side2_player1_id]['loss'] += 1;
                $arr[$game->side2_player2_id]['loss'] += 1;
            } else if ($game->side_2_score > $game->side_1_score) {
                $arr[$game->side1_player1_id]['loss'] += 1;
                $arr[$game->side1_player2_id]['loss'] += 1;
                $arr[$game->side2_player1_id]['win'] += 1;
                $arr[$game->side2_player2_id]['win'] += 1;
            } else {
                $arr[$game->side1_player1_id]['tie'] += 1;
                $arr[$game->side1_player2_id]['tie'] += 1;
                $arr[$game->side2_player1_id]['tie'] += 1;
                $arr[$game->side2_player2_id]['tie'] += 1;
            }
        }

        
        foreach ($this->tournamentPlayers as $player) {
            array_push($this->leaderboard, [
                'name' => $player->name,
                'score' => $arr[$player->id]['score'], 
                'win' => $arr[$player->id]['win'],
                'tie' => $arr[$player->id]['tie'],
                'loss' => $arr[$player->id]['loss'],
            ]);
        }       

        usort($this->leaderboard, fn($a, $b) =>
            ($b['score'] <=> $a['score'])
            ?: ($b['win'] <=> $a['win'])
        );

    }

    public function render()
    {        
        return view('livewire.tournament-page')
            ->layout('layouts.app');
    }
}