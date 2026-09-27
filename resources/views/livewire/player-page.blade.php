<div>
    <h1>Player</h1>
    
    @switch($mode)

        @case('create')
            @include('livewire.players.create')
            @break

        @case('view')
            @include('livewire.players.view')
            @break

        @case('edit')
            @include('livewire.players.edit')
            @break 

    @endswitch

</div>