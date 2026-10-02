<div class="player-page">
    <div>
        <input wire:model="name" type="text">
    </div>
    <div>
        <input wire:model.live="archived" type="checkbox">
    </div>
    <div>        
        <span wire:click="savePlayer" class="btn btn--medium btn--white">Save</span>        
    </div>
       
</div>