<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property integer id
 * @property boolean gender
 * @property string last_name
 * @property string first_name
 * @property string middle_name
 * @property mixed date_of_birth
 * @property string phone
 * @property string address_zip
 * @property string address_region
 * @property string address_city
 * @property string address_street
 * @property string address_house
 * @property string address_flat
 * @property mixed created_at
 * @property mixed updated_at
 * @property mixed deleted_at
 */
class Person extends Model
{
    use HasFactory;
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'gender',
        'last_name',
        'first_name',
        'middle_name',
        'date_of_birth',
        'phone',
        'address_zip',
        'address_region',
        'address_city',
        'address_street',
        'address_house',
        'address_flat',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'date_of_birth' => 'date',
    ];

    /**
     * Person belongs to the User
     *
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Person belongs to the User
     *
     * @return BelongsTo
     */
    public function legalRepresentative(): BelongsTo
    {
        return $this->belongsTo(LegalRepresentative::class);
    }

    /**
     * Person has one Paper (Passport)
     *
     * @return HasOne
     */
    public function paper(): HasOne
    {
        return $this->hasOne(Paper::class);
    }
}
