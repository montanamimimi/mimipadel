<?php 

namespace App\Livewire;

use Livewire\Component;
use App\Models\Player;
use App\Models\PlayerRatingHistory;

class PlayerPage extends Component
{
    public ?Player $player = null;

    public $name;
    public $archived = false;
    public $ratings;

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
        // $this->player->name = $this->name;
        // $this->player->name = $this->name;
        // $this->player->save();

        $this->player->update(
            [
                'name' => $this->name,
                'archived' => $this->archived
            ]
        );

        return redirect()->route('players.index');
    }

    public function mount(?Player $player = null)
    {            
        $this->player = $player;
        

        if (!$player) {
            $this->mode = 'create';
        } else {

            $this->ratings = $this->player->ratingHistory()
            ->orderBy('created_at')
            ->get()
            ->map(fn ($rating) => [
                'date' => $rating->created_at->format('d M'),
                'rating' => $rating->new_rating,
            ]);        
            $this->name = $player->name;
            $this->archived = $player->archived;
            if (request()->routeIs('players.edit')) {
                $this->mode = 'edit';
            }
        }
    }

    public function render()
    {        

        return view('livewire.player-page')
            ->layout('layouts.app');
    }
}