<?php 

namespace App\Livewire;

use Livewire\Component;
use App\Models\Tournament;

class Welcome extends Component
{
    public function render()
    {
        $tournaments = Tournament::orderBy('created_at', 'desc')->get();
        return view('livewire.welcome', compact('tournaments'))
            ->layout('layouts.app');
    }
}