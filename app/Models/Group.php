<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;

/**
 * Group
 *
 * NOTE: ALL prices are in kopecks !!!
 * because php don't support decimals
 * trim last two symbols to convert into RUB
 *
 * @property int id
 * @property string title
 * @property Carbon start
 * @property Carbon end
 * @property integer base_price NOTE: IN INTEGER
 * @property integer drive_hours NOTE: 56 by default
 * @property integer price_per_driving_hour NOTE: IN INTEGER
 * @property int full_price NOTE: Accessor
 * @property Carbon created_at
 * @property Carbon updated_at
 * @property Carbon deleted_at
 */
class Group extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $dates = [
        'start',
        'end'
    ];

    protected $fillable = [
        'title',
        'start',
        'end',
        'base_price',
        'drive_hours',
        'price_per_driving_hour'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'base_price' => 'integer',
        'price_per_driving_hour' => 'integer',
        'drive_hours' => 'integer'
    ];

    /**
     * @return HasMany
     */
    public function student(): HasMany
    {
        return $this->hasMany(Student::class);
    }

    /**
     * @return HasMany
     */
    public function appointments(): HasMany
    {
        return $this->hasMany(Appointment::class);
    }

    /**
     * Group has one Limit model,
     * that contains three types of limitations -
     * per day, per week, per month
     *
     * @return HasOne
     */
    public function limit(): HasOne
    {
        return $this->hasOne(Limit::class);
    }

    /**
     * Get full price
     *
     * @return int
     */
    public function getFullPriceAttribute(): int
    {
        return $this->price_per_driving_hour * $this->drive_hours + $this->base_price;
    }

    /**
     * Gets drive hours
     *
     * @return int
     */
    public function getDriveHours(): int
    {
        return $this->drive_hours;
    }

    /**
     * @param $query
     * @return mixed
     */
    public function scopeOfThisStudent($query): mixed
    {
        $student = Auth::user()->getAsStudent();

        return $query->where('id', '=', $student->group?->id);
    }
}
