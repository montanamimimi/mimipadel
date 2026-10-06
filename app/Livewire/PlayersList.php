<?php 

namespace App\Livewire;

use Livewire\Component;
use App\Models\Player;

class PlayersList extends Component
{

    public function render()
    {
        
        $players = Player::with('latestRating')
            ->get()
            ->sortByDesc(fn ($player) => $player->latestRating?->new_rating)
            ->sortBy('archived')
            ->values();
         
        return view('livewire.players-list', compact('players'))
            ->layout('layouts.app');
    }
}