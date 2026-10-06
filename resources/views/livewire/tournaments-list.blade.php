<div>
    <h1>Tournaments</h1>
    
    <a href="{{ route('admin.tournaments.create') }}" class="mb-6 btn btn--large btn--white">Add Tournament</a>

    <div class="mb-6 flex flex-col gap-4">
        @foreach( $tournaments as $tournament )
            <div class="tournament
            @if ($tournament->finished)
            tournament--finished
            @endif
            ">
                <div class="tournament__title">{{ $tournament->name }}</div>
                <div>{{ $tournament->date }}</div>
                <div>
                    {{ $tournament->format }}, 
                    {{ $tournament->courts }} courts, 
                    {{ $tournament->points }} points</div>
                <a href="{{ route('tournaments.show', $tournament) }}">Show</a>                      
                <a href="{{ route('admin.tournaments.edit', $tournament) }}">Edit</a>                
            </div>            
        @endforeach
    </div>

</div>