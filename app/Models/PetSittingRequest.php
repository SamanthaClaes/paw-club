<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class PetSittingRequest extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'last_name',
        'first_name',
        'email',
        'animal_type_id',
        'description',
        'animal_name',
        'animal_age',
        'breed',
        'start_date',
        'end_date',
        'image'
    ];

    public function animalType(): BelongsTo
    {
        return $this->belongsTo(AnimalType::class);
    }
}
