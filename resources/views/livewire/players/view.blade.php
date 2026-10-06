<div class="player-page">
    <h2>{{ $player->name }}</h2>
    <div>
        <p>Rating: {{ $player->latestRating?->new_rating; }} </p>
    </div>
    <div>
        <canvas wire:ignore
            id="ratingChart"
            data-labels='@json($chartRatings->map(fn ($rating) => $rating->created_at->format("d M")))'
            data-values='@json($chartRatings->pluck("new_rating"))'
        ></canvas>
    </div>
    @if ($player->archived)
        <div>Player is in archive</div>
    @endif
    <div>
        @if (auth()->check())
        <a href="{{ route('players.edit', $player) }}" class="btn btn--large btn--white mb-6">Edit Player</a>
        @endif        
    </div>
    <div class="ratings">
        @foreach($ratings->sortByDesc('created_at') as $rating)
            @if ($rating->tournamentGame)
            @include('livewire.players.rating', [
                'rating' => $rating,
                'opened' => $openedId
                ])
            @endif
        @endforeach
    </div>
    {{ $ratings->links(data: ['scrollTo' => false]) }}
    
</div>