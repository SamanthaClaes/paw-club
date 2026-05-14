<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class AnimalType extends Model
{
    protected $fillable=['type'];


    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class);
    }

    public function petSittingRequests(): HasMany
    {
        return $this->hasMany(PetSittingRequest::class);
    }
}
