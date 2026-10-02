<?php 

namespace App\Livewire\Tournaments;

use Livewire\Component;
use App\Models\Player;
use App\Models\Tournament;
use App\Models\TournamentPlayer;
use App\Models\TournamentGame;
use App\Models\PlayerRatingHistory;
use Illuminate\Support\Facades\Log;
use Livewire\Attributes\On;

class AdminTournamentPage extends BaseTournamentPage
{

    public $name;
    public $date;
    public $selectedPlayerId;
    public $format = 'mexicano';
    public $courts = 1;
    public $points = 0;
    public $mixer = true;
    public $players;
    public $ready = false;
    public $side1player1id = null;
    public $side1player2id = null;
    public $side2player1id = null;
    public $side2player2id = null;
    public $side1score = null;
    public $side2score = null;
    public $round = null;
    public $error = false;

    public function save()
    {
        $this->validate([
            'name' => 'required|string|max:255',
            'date' => 'required|date',
            'format' => 'required|in:mexicano,americano',
            'courts' => 'required|integer|min:1',
            'points' => 'required|integer|min:1',
        ]);

        Tournament::create([
            'user_id' => auth()->id(),
            'name' => $this->name,
            'date' => $this->date,
            'format' => $this->format,
            'courts' => $this->courts,
            'points' => $this->points,
            'mixer' => $this->mixer,
        ]);

        return redirect()->route('admin.tournaments.index');
    }

    public function updateTournamentFinished()
    {       
        $this->tournament->finished = $this->finished;
        $this->tournament->save();
        return redirect()->route('admin.tournaments.index');
    }

    public function addPlayer() {
        
        $player = Player::find($this->selectedPlayerId);

        if($player) {
            $tplayer = TournamentPlayer::create([
                'tournament_id' => $this->tournament->id,
                'player_id' => $player->id,
                'name' => $player->name,
            ]);

            $this->tournamentPlayers->prepend($tplayer);

            $this->checkPlayersReady();
        }

    }

    public function removePlayer($id) {
        TournamentPlayer::findOrFail($id)->delete();
        $this->tournamentPlayers = $this->tournamentPlayers->reject(fn ($item) => $item->id == $id);
        $this->checkPlayersReady();
    }

    #[On('deleteGame')] 
    public function deleteGame($gameId) {
        TournamentGame::findOrFail($gameId)->delete();
        $this->tournamentGames = $this->tournamentGames->reject(fn ($item) => $item->id == $gameId);   
        $this->populateLeaderboard();     
    }    

    // manual mode now !!! don't realy generating tournament games

    public function startTournament() {
        $this->tournament->started = true;
        $this->tournament->save();        
        $this->mode = "play";
        $this->tournamentPlayers = TournamentPlayer::with('player')
        ->where('tournament_id', $this->tournament->id)
        ->orderBy('name')
        ->get();
    }

    #[On('addTournamentGame')] 
    public function addTournamentGame() {

        if (
            is_null($this->side1player1id) ||
            is_null($this->side1player2id) ||
            is_null($this->side2player1id) ||
            is_null($this->side2player2id) ||
            is_null($this->side1score) ||
            is_null($this->side2score) ||
            is_null($this->round) 
        ) {
            $this->error = true;
        } else {            

            $game = TournamentGame::create([
                'tournament_id' => $this->tournament->id,
                'round' => $this->round,
                'side1_player1_id' => $this->side1player1id,
                'side1_player2_id' => $this->side1player2id,
                'side2_player1_id' => $this->side2player1id,
                'side2_player2_id' => $this->side2player2id,
                'side_1_score' => $this->side1score,
                'side_2_score' => $this->side2score
            ]);

            $this->tournamentGames->push($game);
            $this->populateLeaderboard();

            if ((count($this->tournamentGames) % $this->tournament->courts) == 0) {
                $this->round++;
            }

            $this->side1player1id = null;
            $this->side1player2id = null;
            $this->side2player1id = null;
            $this->side2player2id = null;
            $this->side1score = null;
            $this->side2score = null;
        }

    }

    private function checkPlayersReady() {
        if (count($this->tournamentPlayers) == $this->tournament->courts * 4) {
            $this->ready = true;
        } else {
            $this->ready = false;
        }
    }

    public function mount(?Tournament $tournament = null)
    {   
       
        parent::mount($tournament);

        $this->tournament = $tournament;

        if ($tournament) {
            if ((count($this->tournamentGames) % $this->tournament->courts) == 0) {
                $this->round++;
            }
                       
            $this->checkPlayersReady();

            if (request()->routeIs('admin.tournaments.edit'))  {
                if (!$tournament->started) {
                    $this->mode = 'edit';
                    $this->players = Player::orderBy('name')
                        ->where('archived', false)
                        ->get();            
                } else {
                    $this->mode = "play";
                    $this->round = floor(count($this->tournamentGames) / $this->tournament->courts);
                }
            }    
        } 

    }

    public function render()
    {        
        return view('livewire.tournament-page')
            ->layout('layouts.app');
    }
}