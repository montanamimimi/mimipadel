<div>
    <h1>
        @if($tournament)
        {{ $tournament->name }}
        @else
        Tournament
        @endif
    </h1>
    
    @switch($mode)

        @case('create')
            @include('livewire.tournaments.create')
            @break

        @case('view')
            @include('livewire.tournaments.view')
            @break

        @case('play')
            @include('livewire.tournaments.play')
            @break            

        @case('edit')
            @include('livewire.tournaments.edit')
            @break 

    @endswitch

</div>