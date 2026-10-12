<?php 

namespace App\Livewire;

use Livewire\Component;

class RatingsExplained extends Component
{
    public function render()
    {       
        return view('livewire.ratings-explained')
            ->layout('layouts.app');
    }
}