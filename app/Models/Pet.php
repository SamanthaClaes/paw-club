<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;

class Pet extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name',
        'breed',
        'birth_date',
        'description',
        'user_id',
        'pet_image',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function birthDateFormat()
    {
        $birthdate = Carbon::parse($this->birth_date);
        $months = floor($birthdate->diffInMonths(Carbon::now()));
        $years = floor($birthdate->diffInYears(Carbon::now()));


        if ($years < 1){
            return $months . ' ' . "mois";
        }
        return $years . ' ' . ($years === 1 ? 'an' : 'ans');

    }
}
