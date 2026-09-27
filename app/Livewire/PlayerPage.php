<?php 

namespace App\Livewire;

use Livewire\Component;
use App\Models\Player;
use App\Models\PlayerRatingHistory;

class PlayerPage extends Component
{
    public ?Player $player = null;

    public $name;

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

    public function mount(?Player $player = null)
    {
        $this->player = $player;

        if (!$player) {
            $this->mode = 'create';
        }
    }

    public function render()
    {        
        return view('livewire.player-page')
            ->layout('layouts.app');
    }
}