@if ($mode === 'view')
    <div class="game">                
        
        <div class="game__team game__team--left">            
            <div class="game__player game__player--left">{{ $game->side1Player1->player->name }}</div>
            @if($showRating)
                <div class="game__player game__player--left">
                    <p class="x-small">
                        {{ $game->playerRatings->firstWhere('player_id', $game->side1Player1->player->id)->old_rating }}
                    </p>
                </div>
            @endif            
            <div class="game__player game__player--left">{{ $game->side1Player2->player->name }}</div>
            @if($showRating)
                <div class="game__player game__player--left">
                    <p class="x-small">
                        {{ $game->playerRatings->firstWhere('player_id', $game->side1Player2->player->id)->old_rating }}
                    </p>
                </div>
            @endif            
            <div class="game__score game__score--left">{{ $game->side_1_score}}</div>
        
        
        
        </div>
        <div class="game__team game__team--right">
            <div class="game__player game__player--right">{{ $game->side2Player1->player->name }}</div>
            @if($showRating)
                <div class="game__player game__player--right">
                    <p class="x-small">
                        {{ $game->playerRatings->firstWhere('player_id', $game->side2Player1->player->id)->old_rating }}
                    </p>
                </div>
            @endif
            <div class="game__player game__player--right">{{ $game->side2Player2->player->name }}</div>
            @if($showRating)
                <div class="game__player game__player--right">
                    <p class="x-small">
                        {{ $game->playerRatings->firstWhere('player_id', $game->side2Player2->player->id)->old_rating }}
                    </p>
                </div>
            @endif            
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