<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class AnimalType extends Model
{
    protected $fillable=['type'];


    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class);
    }
}
