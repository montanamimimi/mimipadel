<div>

    <x-tournament-game-view
        :players="$tournamentPlayers"       
        :tournament="$tournament"     
        save-event="addTournamentGame"   
        mode="edit"       
    />

    @if($error)
        <div class="text-red-800 mt-6">Something wrong</div>
    @endif    

    <div class="games">
        @foreach ($tournamentGames as $key => $game)    
            
            @if ($key === 0 || $game->round !== $tournamentGames[$key - 1]->round)
                <div class="round">
                <h4>Round {{ $game->round + 1 }}</h4>
            @endif            
                <x-tournament-game-view
                    :players="$tournamentPlayers"
                    :game="$game"
                    :tournament="$tournament"
                    :show-delete="$key === $tournamentGames->count() - 1"     
                    :show-edit="true"  
                    save-event="deleteGame"   
                />    
            @if ($key === $tournamentGames->count() - 1 ||
                $game->round !== $tournamentGames[$key + 1]->round)
                </div>
            @endif
        @endforeach
    </div>

    @if ($leaderboard)
        <h3>Leaderboard</h3>
        <div class="leaderboard">
            <div class="leaderboard__items">
            @foreach ( $leaderboard as $key => $item )
                <div>
                   {{ $key + 1}}. {{ $item['name'] }} {{ $item['score'] }}
                </div>
            @endforeach
            </div>
        </div>
    @endif

    <div class="mt-6">
        <h3>Add photos</h3>
        <form wire:submit="uploadTournamentPhoto">
            <input type="file" wire:model="photo" accept="image/*">
            <button 
                type="submit"
                class="px-4 py-2 bg-indigo-600 text-white rounded-md mt-4 mb-6 hover:bg-indigo-700">
                Upload
            </button>
        </form>
    </div>

    <div class="photos">
        @foreach ($tournament->photos as $photo)
            <div class="photo">
                <img src="{{ Storage::url($photo->path) }}" alt="Tournament photo">
            </div>           
        @endforeach
    </div>
        
    <div class="mt-6">
        <label for="finished">Tournament finished?</label>        
        <input type="checkbox" wire:model="finished">
        <div
            type="button"
            wire:click="updateTournamentFinished"
            class="px-4 py-2 bg-indigo-600 text-white rounded-md mt-4 mb-6
                hover:bg-indigo-700"
        >
            Update 
        </div>        
    </div>

</div>