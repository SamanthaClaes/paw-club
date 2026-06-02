<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;

class Pet extends Model
{
    use SoftDeletes;
    use HasFactory;

    protected $fillable = [
        'name',
        'breed',
        'birth_date',
        'description',
        'user_id',
        'pet_image',
        'animal_type_id',
        'breed_id',
        'gender',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function birthDateFormat(): string
    {
        $birthdate = Carbon::parse($this->birth_date);
        $months = floor($birthdate->diffInMonths(Carbon::now()));
        $years = floor($birthdate->diffInYears(Carbon::now()));


        if ($years < 1){
            return $months . ' ' . "mois";
        }
        return $years . ' ' . ($years === 1 ? 'an' : 'ans');

    }
    public function animalType(): BelongsTo
    {
        return $this->belongsTo(AnimalType::class);
    }

    public function breed(): BelongsTo
    {
        return $this->belongsTo(Breed::class);
    }

    public function petSittingRequests(): HasMany
    {
        return $this->hasMany(PetSittingRequest::class);
    }
    public function getImageUrl(int $size = 400): ?string
    {
        if (!$this->pet_image) {
            return null;
        }

        $fileName = basename($this->pet_image);

        return Storage::disk('s3')->url(
            "images/{$size}/{$fileName}"
        );
    }
}
