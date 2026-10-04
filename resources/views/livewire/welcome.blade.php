<div>

    <h1>Tournaments</h1>

    <div class="tournaments">
        @foreach( $tournaments as $tournament )
            <x-tournament-card :tournament="$tournament" />
        @endforeach
    </div>    
</div>