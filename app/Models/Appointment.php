<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property int id
 * @property Carbon date
 * @property int group_id
 * @property int vehicle_id
 * @property int driving_schedule_id
 * @property int place_id
 * @property int student
 * @property int instructor
 * @property string comment
 * @property Carbon created_at
 * @property Carbon updated_at
 * @property Carbon deleted_at
 */
class Appointment extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'date',
        'group_id',
        'vehicle_id',
        'driving_schedule_id',
        'place_id',
        'student',
        'instructor',
        'comment',
    ];

    /**
     * Appointment belongs to Driving Schedule
     *
     * @return BelongsTo
     */
    public function drivingSchedule(): BelongsTo
    {
        return $this->belongsTo(DrivingSchedule::class);
    }

    /**
     * @return BelongsTo
     */
    public function group(): BelongsTo
    {
        return $this->belongsTo(Group::class);
    }

    /**
     * @return BelongsTo
     */
    public function place(): BelongsTo
    {
        return $this->belongsTo(Place::class);
    }

    /**
     * @return BelongsTo
     */
    public function vehicle(): BelongsTo
    {
        return $this->belongsTo(Vehicle::class);
    }

    /**
     * @return BelongsTo
     */
    public function student(): BelongsTo
    {
        return $this->belongsTo(Student::class);
    }

    /**
     * @return BelongsTo
     */
    public function instructor(): BelongsTo
    {
        return $this->belongsTo(User::class, 'instructor');
    }
}
