<div>
    <a href="{{ route('tournaments.show', $tournament) }}">
        <div class="tournament">            
            <div class="tournament__title">{{ date('j M Y', strtotime($tournament->date)) }}</div>
            
            <div>
                {{ $tournament->format }}, 
                {{ $tournament->courts }} courts, 
                {{ $tournament->points }} points</div>           
        </div>            
    </a>
</div>