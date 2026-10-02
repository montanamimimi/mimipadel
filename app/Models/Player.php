<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\PlayerRatingHistory;

class Player extends Model
{    

    public $incrementing = false;
    protected $keyType = 'string';
    use HasUlids;
    
    protected $fillable = [
        'id',
        'user_id',
        'name',
        'archived'
    ];

    public function ratingHistory(): HasMany
    {
        return $this->hasMany(PlayerRatingHistory::class);
    }

    public function latestRating()
    {
        return $this->hasOne(PlayerRatingHistory::class)->latestOfMany();
    }    

}
