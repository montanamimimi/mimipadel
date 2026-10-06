<div>

    @if ($leaderboard)
        <h3>Leaderboard</h3>
        <div class="leaderboard">
            
            <div class="leaderboard__items">
            @foreach ( $leaderboard as $key => $item )
                <div class="leaderboard__item">
                    <div>{{ $key + 1}}. {{ $item['name'] }}</div>
                    <div>{{ $item['score'] }}</div>                    
                </div>
            @endforeach
            </div>
        </div>
    @endif

    <h3>Rounds</h3>

    <div class="games">
        @foreach ($tournamentGames as $key => $game)    
            
            @if ($key === 0 || $game->round !== $tournamentGames[$key - 1]->round)
                <div class="round">
                <h4>Round #{{ $game->round + 1 }}</h4>
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


</div>