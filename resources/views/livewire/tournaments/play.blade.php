<div>
    <div>
        <div>
            <label for="round" class="block text-sm font-medium text-gray-700">
                ROUND ID
            </label>
        </div>
        <div>
            <input 
                id="round" 
                wire:model="round" 
                type="number"
                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm
                focus:border-indigo-500 focus:ring-indigo-500"
            >
        </div>
    </div>    
    <div class="flex items-center justify-center align-top gap-4 mb-6">
        <div>
            <div class="mb-2">
                <label for="side1player1id" class="block text-sm font-medium text-gray-700">
                    player 1 side 1
                </label>
            </div>
            <div class="mb-4">
                <select 
                    id="side1player1id"
                    wire:model="side1player1id"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm
                    focus:border-indigo-500 focus:ring-indigo-500"
                >
                    <option value="">Select player</option>
                    @foreach ($tournamentPlayers as $player)
                        <option value="{{ $player->id }}">{{ $player->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-2">
                <label for="side1player2id" class="block text-sm font-medium text-gray-700">
                    player 2 side 1
                </label>
            </div>
            <div>
                <select 
                    id="side1player2id"
                    wire:model="side1player2id"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm
                    focus:border-indigo-500 focus:ring-indigo-500"                
                >                
                    <option value="">Select player</option>
                    @foreach ($tournamentPlayers as $player)
                        <option value="{{ $player->id }}">{{ $player->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div>
            <div class="mb-2">
                <label for="side2player1id" class="block text-sm font-medium text-gray-700">
                    player 1 side 2
                </label>
            </div>
            <div class="mb-4">
                <select 
                    id="side2player1id"
                    wire:model="side2player1id"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm
                    focus:border-indigo-500 focus:ring-indigo-500"
                >
                    <option value="">Select player</option>
                    @foreach ($tournamentPlayers as $player)
                        <option value="{{ $player->id }}">{{ $player->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-2">
                <label for="side2player2id" class="block text-sm font-medium text-gray-700">
                    player 2 side 2
                </label>
            </div>
            <div>
                <select 
                    id="side2player2id"
                    wire:model="side2player2id"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm
                    focus:border-indigo-500 focus:ring-indigo-500"                
                >
                    <option value="">Select player</option>
                    @foreach ($tournamentPlayers as $player)
                        <option value="{{ $player->id }}">{{ $player->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div>
            <div>
                <label for="side1score" class="block text-sm font-medium text-gray-700">
                    side 1 score
                </label>
            </div>
            <div>
                <input 
                    id="side1score" 
                    wire:model="side1score" 
                    type="number"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm
                    focus:border-indigo-500 focus:ring-indigo-500"
                >
            </div>
        </div>        
        <div>
            <div>
                <label for="side2score" class="block text-sm font-medium text-gray-700">
                    side 2 score
                </label>
            </div>
            <div>
                <input 
                    id="side2score" 
                    wire:model="side2score" 
                    type="number"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm
                    focus:border-indigo-500 focus:ring-indigo-500"
                >
            </div>
        </div>        
    </div>
    <div>
        <div
            type="button"
            wire:click="addTournamentGame"
            class="px-4 py-2 bg-indigo-600 text-white rounded-md mb-6
                hover:bg-indigo-700"
        >
            Add game
        </div>
    </div>

    @if($error)
        <div class="text-red-800 mt-6">Something wrong</div>
    @endif    

    <div class="games">
        @foreach ($tournamentGames as $key => $game)
            
            @if ($key === 0 || $game->round !== $tournamentGames[$key - 1]->round)
                <div class="round">
                <h4>Round {{ $game->round + 1 }}</h4>
            @endif            
                <div class="game">                
                    
                    <div class="game__test">
                    {{ $tournamentPlayers->firstWhere('id', $game->side1_player1_id)?->player?->name }}
                    & 
                    {{ $tournamentPlayers->firstWhere('id', $game->side1_player2_id)?->player?->name }}
                    {{ $game->side_1_score}}
                    </div>
                    <div>
                    {{ $tournamentPlayers->firstWhere('id', $game->side2_player1_id)?->player?->name }}
                    & 
                    {{ $tournamentPlayers->firstWhere('id', $game->side2_player2_id)?->player?->name }}
                    {{ $game->side_2_score}}
                    </div>
                    <div wire:click="deleteGame('{{ $game->id }}')" class="game__delete">
                        delete game
                    </div>
                </div>
            @if ($key === $tournamentGames->count() - 1 ||
                $game->round !== $tournamentGames[$key + 1]->round)
                </div>
            @endif
        @endforeach
    </div>

    @if ($leaderboard)
        <div class="leaderboard">
            <h3>Leaderboard</h3>
            @foreach ( $leaderboard as $key => $item )
                <div>
                   {{ $key + 1}}. {{ $item['name'] }} {{ $item['score'] }}
                </div>
            @endforeach
        </div>
    @endif

</div>