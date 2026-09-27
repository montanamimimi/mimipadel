<div>
    <h1>Players</h1>

    <a href="{{ route('players.create') }}" class="btn btn--large btn--white mb-6">Add Player</a>

    <div class="mb-6 flex flex-col gap-4">
        @foreach( $players as $player )
            <div class="player mb-6 flex gap-2 items-center">
                <div class="player__title">{{ $player->name }}</div>
                <div>{{ $player->latestRating->new_rating; }}</div>
                
                <a href="{{ route('players.show', $player) }}" class="player__link">Show</a>                
            </div>            
        @endforeach
    </div>    
</div>