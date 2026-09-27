<div class="max-w-2xl mx-auto p-6">
    <h2 class="text-2xl font-semibold mb-6">Create Tournament</h2>

    <form wire:submit="save" class="space-y-5">

        {{-- Name --}}
        <div>
            <label for="name" class="block text-sm font-medium text-gray-700">
                Name
            </label>

            <input
                type="text"
                id="name"
                wire:model="name"
                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm
                    focus:border-indigo-500 focus:ring-indigo-500"
                placeholder="Saturday Tournament"
            >

            @error('name')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        {{-- Date --}}
        <div>
            <label for="date" class="block text-sm font-medium text-gray-700">
                Date
            </label>

            <input
                type="date"
                id="date"
                wire:model="date"
                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm
                    focus:border-indigo-500 focus:ring-indigo-500"
            >

            @error('date')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        {{-- Format --}}
        <div>
            <label for="format" class="block text-sm font-medium text-gray-700">
                Format
            </label>

            <select
                id="format"
                wire:model="format"
                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm
                    focus:border-indigo-500 focus:ring-indigo-500"
            >
                <option value="mexicano">Mexicano</option>
                <option value="americano">Americano</option>
            </select>

            @error('format')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        {{-- Courts --}}
        <div>
            <label for="courts" class="block text-sm font-medium text-gray-700">
                Courts
            </label>

            <input
                type="number"
                id="courts"
                wire:model="courts"
                min="1"
                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm
                    focus:border-indigo-500 focus:ring-indigo-500"
            >
        </div>

        {{-- Points --}}
        <div>
            <label for="points" class="block text-sm font-medium text-gray-700">
                Points
            </label>

            <input
                type="number"
                id="points"
                wire:model="points"
                min="1"
                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm
                    focus:border-indigo-500 focus:ring-indigo-500"
            >
        </div>

        {{-- Mixer --}}
        <div class="flex items-center">
            <input
                type="checkbox"
                id="mixer"
                wire:model="mixer"
                class="rounded border-gray-300 text-indigo-600 focus:ring-indigo-500"                                        
            >

            <label for="mixer" class="ml-2 text-sm text-gray-700">
                Mixer
            </label>
        </div>

        <button
            type="submit"
            class="px-4 py-2 bg-indigo-600 text-white rounded-md
                hover:bg-indigo-700"
        >
            Create Tournament
        </button>

    </form>
</div>