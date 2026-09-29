<div>
    @if (!$ready)
        <h3>Add players</h3>
        
        <div>
            <label for="name" class="block text-sm font-medium text-gray-700">
                Player
            </label>

            <select wire:model="selectedPlayerId">         
                <option value="">???</option>       
                @foreach($players as $player)
                    <option value="{{ $player->id }}">{{ $player->name }}</option>
                @endforeach
            </select>
        </div>


        <button
            type="button"
            wire:click="addPlayer"
            class="px-4 py-2 bg-indigo-600 text-white rounded-md
                hover:bg-indigo-700"
        >
            add
        </button>    
    @else
        <button
            type="button"
            wire:click="startTournament"
            class="px-4 py-2 bg-indigo-600 text-white rounded-md
                hover:bg-indigo-700"
        >
            start!
        </button> 
    @endif

    <h2>Players List</h2>
    <div class="players-list">

        @foreach ($tournamentPlayers as $tplayer)
            <div class="players-list__item">
                <div class="players-list__name">
                    {{ $tplayer->name }}
                </div>
                <div wire:click="removePlayer('{{ $tplayer->id }}')" class="players-list__delete">
                    X
                </div>
            </div>
        @endforeach
    </div>




   
</div>