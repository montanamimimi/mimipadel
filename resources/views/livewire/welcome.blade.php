<div>
    <img src="{{ asset('images/mimi_logo.png') }}" alt="Logo">

    <h1>Tournaments</h1>

    <div class="mb-6 flex flex-col gap-4">
        @foreach( $tournaments as $tournament )
            <a href="{{ route('tournaments.show', $tournament) }}">
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
                </div>            
            </a>
        @endforeach
    </div>    
</div>