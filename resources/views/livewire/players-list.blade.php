<div>
    <h1>Players</h1>
    <p class="mb-6">
        <a href="{{ route('ratings.explained') }}" style="text-decoration: underline;">
            How does it works?
        </a>
    </p>

    @if (auth()->check())
    <a href="{{ route('players.create') }}" class="btn btn--large btn--white mb-6">Add Player</a>
    @endif
    <div class="players">
        @foreach( $players as $key => $player )
        <a class="
                player
                @if ($player->archived)
                player--archived
                @endif
                " 
            href="{{ route('players.show', $player) }}">
           
            <div class="player__title">
                {{ $key + 1}}. {{ $player->name }}
            </div>                    
            
            <div>{{ $player->latestRating?->new_rating; }}</div>                          
           
        </a>                      
        @endforeach
    </div>    
</div>