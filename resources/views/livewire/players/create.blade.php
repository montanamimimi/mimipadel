<div class="max-w-2xl mx-auto p-6">
    <h2 class="text-2xl font-semibold mb-6">Create Player</h2>

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
                placeholder="Enter name"
            >

            @error('name')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <button
            type="submit"
            class="capitalize px-4 py-2 bg-indigo-600 text-white rounded-md
                hover:bg-indigo-700"
        >
            Create Player
        </button>

    </form>
</div>