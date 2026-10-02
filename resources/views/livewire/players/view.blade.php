<div class="player-page">
    <h2>{{ $player->name }}</h2>
    <div>
        <p>Rating: {{ $player->latestRating->new_rating; }} </p>
    </div>
    @if ($player->archived)
        <div>Player is in archive</div>
    @endif
    <div>
        @if (auth()->check())
        <a href="{{ route('players.edit', $player) }}" class="btn btn--large btn--white mb-6">Edit Player</a>
        @endif        
    </div>
</div>