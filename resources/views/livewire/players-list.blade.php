<div>
    <h1>Players</h1>

    <a href="{{ route('players.create') }}" class="btn btn--large btn--white mb-6">Add Player</a>

    <div class="players">
        @foreach( $players as $key => $player )
        <a href="{{ route('players.show', $player) }}">
            <div class="player">
                <div class="player__title">
                    {{ $player->name }}
                </div>                    
                @if ($player->latestRating) 
                    <div>{{ $player->latestRating->new_rating; }}</div>     
                @else
                    <div>
                        Error! No rating for player_id {{ $player->id }}
                    </div>
                @endif
                     
            </div>   
        </a>                      
        @endforeach
    </div>    
</div>