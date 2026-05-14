<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\enum\UserRole;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

#[Fillable(['last_name','first_name', 'email', 'password', 'role', 'phone', 'adress', 'zip', 'image', 'location', 'description', 'habitation_id'])]
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
}
