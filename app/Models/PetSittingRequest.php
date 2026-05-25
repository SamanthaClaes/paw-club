<?php

namespace App\Models;

use App\Enums\PetsitterRequestStatus;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class PetSittingRequest extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'description',
        'start_date',
        'end_date',
        'image',
        'status',
        'pet_id',
        'user_id',
        'petsitter_id',
        'note',
    ];
    protected $casts = [
        'status' => PetsitterRequestStatus::class,
    ];

    public function animalType(): BelongsTo
    {
        return $this->belongsTo(AnimalType::class);
    }

    public function pet(): BelongsTo
    {
        return $this->belongsTo(Pet::class);
    }

    public function user(): BelongsTo
    {
      return  $this->belongsTo(User::class);
    }
    public function petsitter(): BelongsTo
    {
        return $this->belongsTo(User::class, 'petsitter_id');
    }
}
