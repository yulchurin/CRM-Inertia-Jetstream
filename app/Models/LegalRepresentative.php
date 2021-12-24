<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class LegalRepresentative extends Model
{
    use HasFactory;

    /**
     * Legal Representative belongs to a User
     *
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * LP has a Person
     *
     * @return HasOne
     */
    public function person(): HasOne
    {
        return $this->hasOne(Person::class);
    }
}
