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
            <x-player-select
                id="side1player1id"
                label="player 1 side 1"
                model="side1player1id"
                :players="$players"                
            />
            <x-player-select
                id="side1player2id"
                label="player 2 side 1"
                model="side1player2id"
                :players="$players"                
            />
        </div>

        <div>
            <x-player-select
                id="side2player1id"
                label="player 1 side 2"
                model="side2player1id"
                :players="$players"                
            />
            <x-player-select
                id="side2player2id"
                label="player 2 side 2"
                model="side2player2id"
                :players="$players"                
            />
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
            wire:click="$dispatch('{{ $saveEvent }}')"
            class="px-4 py-2 bg-indigo-600 text-white rounded-md mb-6
                hover:bg-indigo-700"
        >
            Save
        </div>
    </div>
</div>    