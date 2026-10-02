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
            $arr[$player->id] = 0;
        }        

        foreach ($this->tournamentGames as $game) {
            $arr[$game->side1_player1_id] += $game->side_1_score;
            $arr[$game->side1_player2_id] += $game->side_1_score;
            $arr[$game->side2_player1_id] += $game->side_2_score;
            $arr[$game->side2_player2_id] += $game->side_2_score;
        }

        
        foreach ($this->tournamentPlayers as $player) {
            array_push($this->leaderboard, [
                'name' => $player->name,
                'score' => $arr[$player->id]
            ]);
        }       

        usort($this->leaderboard, fn($a, $b) => $b['score'] <=> $a['score']);

    }

    public function render()
    {        
        return view('livewire.tournament-page')
            ->layout('layouts.app');
    }
}