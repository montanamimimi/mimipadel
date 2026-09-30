<div>
    <div class="mb-2">
        <label for="{{ $id }}" class="block text-sm font-medium text-gray-700">
            {{ $label }}
        </label>
    </div>
    <div class="mb-4">
        <select 
            id="{{ $id }}" 
            wire:model="{{ $model }}" 
            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" >
            <option value="">Select player</option> 
            @foreach ($players as $player) 
            <option value="{{ $player->id }}">{{ $player->name }}</option> 
            @endforeach 
        </select>
    </div>    
</div>    