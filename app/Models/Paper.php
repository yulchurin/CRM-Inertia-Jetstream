<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Due to the fact that Laravel uses the word "passport" for authentication library
 * we forced to use "Paper" instead of "Passport"
 *
 * @property integer id
 * @property string series
 * @property string number
 * @property string issuer
 * @property Carbon issuance_date
 * @property string place_of_birth
 */
class Paper extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $dates = ['issuance_date'];

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'series',
        'number',
        'issuer',
        'issuance_date',
        'place_of_birth',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'issuance_date' => 'date',
    ];

    /**
     * Paper (Passport) belongs to a Person
     *
     * @return BelongsTo
     */
    public function person(): BelongsTo
    {
        return $this->belongsTo(Person::class);
    }
}
