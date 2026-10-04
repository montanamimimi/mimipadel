@if ($mode === 'view')
    <div class="game">                
        
        <div class="game__team game__team--left">
            <div class="game__player game__player--left">{{ $players->firstWhere('id', $game->side1_player1_id)?->player?->name }}</div>
            <div class="game__player game__player--left">{{ $players->firstWhere('id', $game->side1_player2_id)?->player?->name }}</div>
            <div class="game__score game__score--left">{{ $game->side_1_score}}</div>
        
        
        
        </div>
        <div class="game__team game__team--right">
            <div class="game__player game__player--right">{{ $players->firstWhere('id', $game->side2_player1_id)?->player?->name }}</div>
            <div class="game__player game__player--right">{{ $players->firstWhere('id', $game->side2_player2_id)?->player?->name }}</div>
            <div class="game__score game__score--right">{{ $game->side_2_score}}</div>
        </div>

    </div>
    <div class="game__edit">
        @if ($showEdit)
        <a href="{{ route('tournaments.games.show', [$tournament, $game]) }}" class="game__delete">
            edit game
        </a>             
        @endif
        @if (!$tournament->finished && $showDelete)       
            <div wire:click="$dispatch('{{ $saveEvent }}', { gameId: '{{ $game->id }}' })" class="game__delete">
                delete game
            </div>
        @endif
    </div>
@else
    @include('components.tournament-game-edit')    
@endif