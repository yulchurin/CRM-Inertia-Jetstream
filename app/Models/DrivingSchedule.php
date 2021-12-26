<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property mixed start
 * @property int duration
 */
class DrivingSchedule extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'start',
        'duration',
    ];

    /**
     * @return HasMany
     */
    public function appointments(): HasMany
    {
        return $this->hasMany(Appointment::class);
    }
}
