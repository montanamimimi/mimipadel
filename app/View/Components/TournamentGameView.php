<?php

namespace App\View\Components;

use Illuminate\View\Component;
use Illuminate\View\View;

class TournamentGameView extends Component
{
    public function __construct(
        public $players,
        public $tournament,
        public $game = null,
        public string $mode = 'view',
        public string $saveEvent = '',
        public bool $showDelete = false,
    ) {}

    public function render(): View
    {
        return view('components.tournament-game-view');
    }
}