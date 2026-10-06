<div class="tournament">
    <a class="tournament__link" href="{{ route('tournaments.show', $tournament) }}">
                 
        <div class="tournament__title">{{ date('j M Y', strtotime($tournament->date)) }}</div>
        
        <div>
            {{ $tournament->format }}, 
            {{ $tournament->courts }} courts, 
            {{ $tournament->points }} points</div>           
            
    </a>
</div>