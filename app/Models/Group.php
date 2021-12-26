<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Group
 *
 * NOTE: ALL prices are in kopecks !!!
 * because php don't support decimals
 * trim last two symbols to convert into RUB
 * btw using float in finance is a bad idea
 *
 * @property int id
 * @property string title
 * @property Carbon start
 * @property Carbon end
 * @property integer base_price NOTE: IN INTEGER
 * @property integer drive_hours NOTE: 56 by default
 * @property integer price_per_driving_hour NOTE: IN INTEGER
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
     * @return HasMany
     */
    public function user(): HasMany
    {
        return $this->hasMany(User::class);
    }
}
