<?php 

namespace App\Livewire;

use Livewire\Component;
use App\Models\Player;
use App\Models\PlayerRatingHistory;
use Livewire\WithPagination;

class PlayerPage extends Component
{
    use WithPagination;
    
    public ?Player $player = null;

    public $name;
    public $archived = false;
    public $chartRatings;
    public $openedId;
    public $openedRating;

    public string $mode = 'view';

    public function save()
    {
        $this->validate([
            'name' => 'required|string|max:255',
        ]);

        $this->name = ucfirst($this->name);

        $player = Player::create([            
            'name' => $this->name,
        ]);

        PlayerRatingHistory::create([            
            'player_id' => $player->id,            
            'old_rating' => 1500,
            'rating_change' => 0,
            'new_rating' => 1500,
        ]);

        return redirect()->route('players.index');
    }

    public function savePlayer() 
    {
        $this->name = ucfirst($this->name);

        $this->player->update(
            [
                'name' => $this->name,
                'archived' => $this->archived
            ]
        );

        return redirect()->route('players.index');
    }

    public function openRating($id) 
    {
        $this->openedId = $id;

        $this->openedRating = PlayerRatingHistory::with([
            'tournamentGame.tournament',
            'tournamentGame.side1Player1',
            'tournamentGame.side1Player2',
            'tournamentGame.side2Player1',
            'tournamentGame.side2Player2',            
        ])->findOrFail($id);  

       // dd($this->openedRating->tournamentGame->side1Player1->player->name);
        
    }

    public function mount(?Player $player = null)
    {            
        $this->player = $player;
        

        if (!$player) {
            $this->mode = 'create';
        } else {

            $this->chartRatings = $this->player->ratingHistory()
                ->orderBy('created_at')
                ->get();

            $this->name = $player->name;
            $this->archived = $player->archived;
            if (request()->routeIs('players.edit')) {
                $this->mode = 'edit';
            }
        }
    }

    public function render()
    {        
        
        $ratings = null;
        $chartRatings = collect();

        if ($this->player) {
            
            $ratings = $this->player->ratingHistory()            
                ->orderByDesc('created_at')
                ->paginate(20);

        }

        return view('livewire.player-page', [
            'ratings' => $ratings,
            'chartRatings' => $chartRatings,
        ]);    

        return view('livewire.player-page', [
            'ratings' => $ratings,
            'chartRatings' => $chartRatings,
        ])
        ->layout('layouts.app');
    }
}