@section('meta')
    <meta property="og:title" content="{{ $tournament->name }}">
    <meta property="og:description" content="View tournament details on MimiPadel.">
    <meta property="og:image"
          content="{{ url(\Illuminate\Support\Facades\Storage::url($tournament->photos->first()->path ?? 'images/share-default.jpg')) }}">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:type" content="website">
@endsection

<div>
    
    @if ($leaderboard)
        <h3>Leaderboard</h3>
        <div class="leaderboard">
            
            <div class="leaderboard__items">
                <div class="leaderboard__item leaderboard__item--header">
                    <div></div>
                    <div class="leaderboard__scores">
                        <div>
                            <div>W-L-T</div>
                        </div>      
                        <div>Score</div>      
                    </div>                       
                </div>                
            @foreach ( $leaderboard as $key => $item )
                <div class="leaderboard__item">
                    <div>{{ $key + 1}}. {{ $item['name'] }}</div>
                    <div class="leaderboard__scores">
                        <div>
                            <div>{{ $item['win'] }}-{{ $item['loss'] }}-{{ $item['tie'] }}</div>
                        </div>      
                        <div>{{ $item['score'] }}</div>      
                    </div>                       
                </div>
            @endforeach
            </div>
        </div>
    @endif

    <div class="photos">
        @foreach ($tournament->photos as $photo)
            <div class="photo">
                <img src="{{ Storage::url($photo->path) }}" alt="Tournament photo">
            </div>           
        @endforeach
    </div>    

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