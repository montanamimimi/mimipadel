<?php 

namespace App\Livewire;

use Livewire\Component;
use App\Models\Player;
use App\Models\Tournament;
use App\Models\TournamentPlayer;
use App\Models\TournamentGame;
use App\Models\PlayerRatingHistory;
use App\Services\EloRatingService;
use Illuminate\Support\Facades\Log;

class TournamentPage extends Component
{
    public ?Tournament $tournament = null;
    protected EloRatingService $elo;

    public $name;
    public $date;
    public $selectedPlayerId;
    public $format = 'mexicano';
    public $courts = 1;
    public $points = 0;
    public $mixer = true;
    public $players;
    public $tournamentPlayers;
    public $tournamentGames;
    public $ready = false;
    public $side1player1id = null;
    public $side1player2id = null;
    public $side2player1id = null;
    public $side2player2id = null;
    public $side1score = null;
    public $side2score = null;
    public $round = null;
    public $error = false;
    public $leaderboard = [];

    public string $mode = 'view';

    public function boot(EloRatingService $elo)
    {
        $this->elo = $elo;
    }    

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

        return redirect()->route('tournaments.index');
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

    public function deleteGame($id) {
        TournamentGame::findOrFail($id)->delete();
        $this->tournamentGames = $this->tournamentGames->reject(fn ($item) => $item->id == $id);   
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
            $this->changePlayerRating($game->id);
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

    private function changePlayerRating($gameId) {

        $tournamentPlayer1 = $this->tournamentPlayers
        ->firstWhere('id', $this->side1player1id);
        $tournamentPlayer2 = $this->tournamentPlayers
        ->firstWhere('id', $this->side1player2id);
        $tournamentPlayer3 = $this->tournamentPlayers
        ->firstWhere('id', $this->side2player1id);
        $tournamentPlayer4 = $this->tournamentPlayers
        ->firstWhere('id', $this->side2player2id);                        

        $rating = $this->elo->calculate(
            $tournamentPlayer1->player->latestRating->new_rating,
            $tournamentPlayer2->player->latestRating->new_rating,
            $tournamentPlayer3->player->latestRating->new_rating,
            $tournamentPlayer4->player->latestRating->new_rating,
            $this->side1score,
            $this->side2score,
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
                'tournament_id' => $this->tournament->id,
                'player_id' => $tournamentPlayer->player_id,
                'tournament_game_id' => $gameId,
                'old_rating' => $oldRating,
                'rating_change' => $ratingChange,
                'new_rating' => $oldRating + $ratingChange,
            ]);
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
       
        $this->tournament = $tournament;

        if (!$tournament) {
            $this->mode = 'create';
        } else {           
            $this->tournamentPlayers = TournamentPlayer::with('player')
            ->where('tournament_id', $tournament->id)
            ->orderBy('name')
            ->get();

            $this->tournamentGames = TournamentGame::where('tournament_id', $tournament->id)->get();

            $this->populateLeaderboard();

            if ((count($this->tournamentGames) % $this->tournament->courts) == 0) {
                $this->round++;
            }
            $this->round = floor(count($this->tournamentGames) / $this->tournament->courts);
           
            $this->checkPlayersReady();

            if (!$tournament->started) {
                $this->mode = 'edit';
                $this->players = Player::orderBy('name')->get();
            } else {
                $this->mode = "play";
            }
        }

    }

    private function populateLeaderboard() {

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