<?php 

namespace App\Livewire;

use Livewire\Component;
use App\Models\Tournament;
use App\Services\RatingService;

class TournamentsList extends Component
{

    public function render()
    {
        $tournaments = Tournament::orderBy('created_at', 'desc')->get();
        return view('livewire.tournaments-list', compact('tournaments'))
            ->layout('layouts.app');
    }
}