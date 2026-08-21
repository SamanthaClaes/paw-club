<?php

namespace App\Models;

use App\Enums\ActivityType;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Activity extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['user_id', 'type', 'title', 'description', 'pet_id', 'action', 'day_care_request_id'];

    protected function casts(): array
    {
        return [
            'action' => ActivityType::class,
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function pet(): BelongsTo
    {
        return $this->belongsTo(Pet::class);
    }

    public function dayCareRequest(): BelongsTo
    {
        return $this->belongsTo(DayCareRequest::class);
    }
}
