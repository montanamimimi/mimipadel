<div>
    <h1>{{ $tournament->name }}</h1>
    <h2>Round {{ $game->round + 1 }}</h2>

    <x-tournament-game-view
        :players="$tournamentPlayers"       
        :tournament="$tournament"    
        :game="$game"
        save-event="updateTournamentGame"
        mode="edit"       
    />
</div>