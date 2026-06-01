<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\enum\UserRole;
use Auth;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

#[Fillable(['last_name', 'first_name', 'email', 'password', 'role', 'phone', 'adress', 'zip', 'image', 'location', 'description', 'habitation_id', 'petsitter_status', 'is_petsitter', 'price'])]
#[Hidden(['password', 'remember_token'])]
class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'role'=> UserRole::class,
        ];
    }

    public function animalTypes(): BelongsToMany
    {
        return $this->belongsToMany(AnimalType::class);
    }

    public function visitTypes(): BelongsToMany
    {
        return $this->belongsToMany(VisitType::class, 'visit_type_user');
    }
    public function habitation(): BelongsTo
    {
        return $this->belongsTo(Habitation::class);
    }

    public function pets(): HasMany
    {
        return $this->hasMany(Pet::class);
    }

    public function petSittingRequests(): HasMany
    {
        return $this->hasMany(PetSittingRequest::class);
    }

    public function receivedPetSittingRequests(): HasMany
    {
        return $this->hasMany(PetSittingRequest::class, 'petsitter_id');
    }

    public function redirectRoute(): string
    {
        if ($this->role === UserRole::ADMIN) {
            return route('dashboard.index');
        }

        if ($this->is_petsitter) {
            return route('petsitter.profile');
        }

        return route('owner.profile');
    }

    public function petsitterMessages(): HasMany
    {
        return  $this->hasMany(PetsitterMessages::class, 'petsitter_id');
    }

    public function getImageUrl(int $size = 400): ?string
    {
        if (!$this->image) {
            return null;
        }

        $fileName = basename($this->image);

        return asset("storage/images/{$size}/{$fileName}");
    }
}
