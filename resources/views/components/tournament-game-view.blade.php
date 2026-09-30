@if ($mode === 'view')
    <div class="game">                
        
        <div class="game__test">
        {{ $players->firstWhere('id', $game->side1_player1_id)?->player?->name }}
        & 
        {{ $players->firstWhere('id', $game->side1_player2_id)?->player?->name }}
        {{ $game->side_1_score}}
        </div>
        <div>
        {{ $players->firstWhere('id', $game->side2_player1_id)?->player?->name }}
        & 
        {{ $players->firstWhere('id', $game->side2_player2_id)?->player?->name }}
        {{ $game->side_2_score}}
        </div>
        <a href="{{ route('tournaments.games.show', [$tournament, $game]) }}" class="game__delete">
            edit game
        </a>             
        @if (!$tournament->finished && $showDelete)       
            <div wire:click="$dispatch('{{ $saveEvent }}', { gameId: '{{ $game->id }}' })" class="game__delete">
                delete game
            </div>
        @endif
    </div>
@else
    @include('components.tournament-game-edit')    
@endif