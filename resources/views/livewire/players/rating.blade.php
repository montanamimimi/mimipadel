<div class="rating">
    <div wire:click="openRating('{{$rating->id}}')" class="rating__preview">            
        <div class="
        rating__arrow
        @if ($rating->new_rating > $rating->old_rating)
        rating__arrow--up
        @elseif ($rating->new_rating < $rating->old_rating)
        rating__arrow--down
        @else
        rating__arrow--flat
        @endif
        ">
            
        </div>
       
        <p class="x-small">{{ date('j M Y', strtotime($rating->tournamentGame->tournament->date)) }}</p>
    
        <div>           
            {{ $rating->old_rating }} → {{ $rating->new_rating }}
        </div>
    </div>
    @if ($opened == $rating->id)
    <div class="rating__details">
        <div class="games">
            <div class="round">
                <h4>Round #{{ $this->openedRating->tournamentGame->round + 1 }}</h4>            
                <x-tournament-game-view                    
                    :game="$this->openedRating->tournamentGame"
                    :tournament="$this->openedRating->tournamentGame->tournament"
                    :show-delete="false"
                    :show-edit="false"  
                    :show-rating="true"
                />        
            </div> 
        </div>
    </div>
    @endif

</div>