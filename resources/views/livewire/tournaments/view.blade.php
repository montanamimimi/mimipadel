<div>
    
    <div class="games">
        @foreach ($tournamentGames as $key => $game)    
            
            @if ($key === 0 || $game->round !== $tournamentGames[$key - 1]->round)
                <div class="round">
                <h4>Round {{ $game->round + 1 }}</h4>
            @endif            
                <x-tournament-game-view
                    :players="$tournamentPlayers"
                    :game="$game"
                    :tournament="$tournament"
                    :show-delete="false"
                    :show-edit="false"  
                />    
            @if ($key === $tournamentGames->count() - 1 ||
                $game->round !== $tournamentGames[$key + 1]->round)
                </div>
            @endif
        @endforeach
    </div>

    @if ($leaderboard)
        <div class="leaderboard">
            <h3>Leaderboard</h3>
            @foreach ( $leaderboard as $key => $item )
                <div>
                   {{ $key + 1}}. {{ $item['name'] }} {{ $item['score'] }}
                </div>
            @endforeach
        </div>
    @endif
</div>