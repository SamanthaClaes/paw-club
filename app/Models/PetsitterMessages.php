<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class PetsitterMessages extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'phone',
        'message',
        'is_read',
        'petsitter_id',
    ];

    public function petsitter(): BelongsTo
    {
        return $this->belongsTo(User::class, 'petsitter_id');
    }
}
