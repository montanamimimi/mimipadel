<div>
    <h1>Players</h1>

    @if (auth()->check())
    <a href="{{ route('players.create') }}" class="btn btn--large btn--white mb-6">Add Player</a>
    @endif
    <div class="players">
        @foreach( $players as $key => $player )
        <a href="{{ route('players.show', $player) }}">
            <div class="
                player
                @if ($player->archived)
                player--archived
                @endif
                ">
                <div class="player__title">
                    {{ $player->name }}
                </div>                    
                
                <div>{{ $player->latestRating?->new_rating; }}</div>     
                     
            </div>   
        </a>                      
        @endforeach
    </div>    
</div>