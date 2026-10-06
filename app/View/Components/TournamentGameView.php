<?php

namespace App\View\Components;

use Illuminate\View\Component;
use Illuminate\View\View;

class TournamentGameView extends Component
{
    public function __construct(

        public $tournament,
        public $game = null,
        public $players = [],
        public string $mode = 'view',
        public string $saveEvent = '',
        public bool $showDelete = false,
        public bool $showEdit = false,
        public bool $showRating = false,
    ) {}

    public function render(): View
    {
        return view('components.tournament-game-view');
    }
}