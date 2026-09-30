<?php 

namespace App\Livewire;

use Livewire\Component;
use App\Models\Player;
use App\Models\Tournament;
use App\Models\TournamentPlayer;
use App\Models\TournamentGame;
use App\Models\PlayerRatingHistory;
use Illuminate\Support\Facades\Log;
use Livewire\Attributes\On;

class TournamentGamePage extends Component
{
    public Tournament $tournament;
    public TournamentGame $game;
    public $tournamentPlayers;
    public $side1player1id;
    public $side1player2id;
    public $side2player1id;
    public $side2player2id;
    public $side1score;
    public $side2score;
    public $round;

    #[On('updateTournamentGame')]
    public function updateTournamentGame() 
    {
        $this->game->side1_player1_id = $this->side1player1id;
        $this->game->side1_player2_id = $this->side1player2id;
        $this->game->side2_player1_id = $this->side2player1id;
        $this->game->side2_player2_id = $this->side2player2id;
        $this->game->side_1_score = $this->side1score;
        $this->game->side_2_score = $this->side2score;
        $this->game->round = $this->round;

        $this->game->save();

        return redirect()->route('tournaments.show', $this->tournament); 
    }

    public function mount(Tournament $tournament, TournamentGame $game)
    {
        $this->tournament = $tournament;
        $this->game = $game;        
        $this->round = $game->round;    

        $this->side1player1id = $game->side1_player1_id;
        $this->side1player2id = $game->side1_player2_id;
        $this->side2player1id = $game->side2_player1_id;
        $this->side2player2id = $game->side2_player2_id;
        $this->side1score = $game->side_1_score;
        $this->side2score = $game->side_2_score;        

        $this->tournamentPlayers = TournamentPlayer::with('player')
        ->where('tournament_id', $tournament->id)
        ->orderBy('name')
        ->get();        
    }    

    public function render()
    {        
        return view('livewire.tournament-game-page')
            ->layout('layouts.app');
    }
}