<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class PetSittingRequest extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'last_name',
        'first_name',
        'email',
        'image',
        'description',
    ];

    public function animalTypes(): BelongsToMany
    {
        return $this->belongsToMany(AnimalType::class);
    }
}
