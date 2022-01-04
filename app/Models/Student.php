<?php

namespace App\Models;

use App\Scopes\StudentScope;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasOneThrough;

final class Student extends User
{
    protected $table = 'users';

    protected $appends = [
        //'links'
    ];

    /**
     * User has a Person
     *
     * @return HasOne
     */
    public function person(): HasOne
    {
        return $this->hasOne(Person::class, 'user_id');
    }

    /**
     * User has a Paper
     *
     * @return HasOneThrough
     */
    public function paper(): HasOneThrough
    {
        return $this->hasOneThrough(Paper::class, Person::class, 'user_id');
    }

    /**
     * User has a Person
     *
     * @return HasOne
     */
    public function legalRepresentative(): HasOne
    {
        return $this->hasOne(LegalRepresentative::class, 'user_id');
    }

    /**
     * Returns parent's or legal representative's personality
     *
     * @return HasOneThrough
     */
    public function legalRepresentativePerson(): HasOneThrough
    {
        return $this->hasOneThrough(Person::class, LegalRepresentative::class, 'user_id')->with('paper');
    }

    /**
     * Certificate relation
     *
     * @return HasOne
     */
    public function certificate(): HasOne
    {
        return $this->hasOne(Certificate::class, 'user_id');
    }

    /**
     * @return BelongsTo
     */
    public function group(): BelongsTo
    {
        return $this->belongsTo(Group::class);
    }

    /**
     * @return HasMany
     */
    public function appointments(): HasMany
    {
        return $this->hasMany(Appointment::class);
    }

    /**
     * Selects only students from users table
     *
     * UserRole::STUDENT | GRADUATED | ENROLLEE
     *
     * @return void
     */
    protected static function booted()
    {
        Student::addGlobalScope(new StudentScope());
    }

    /**
     * Determines whether Students age is under 18
     *
     * at the moment of Group beginning date
     *
     * or now(), if group has not been specified yet
     *
     * @return boolean
     */
    public function isMinor(): bool
    {
        $legalAge = 18;

        $commencementDate = $this->group?->start ?? now();

        $dateOfBirth = $this->person?->getDateOfBirth();

        return $dateOfBirth > $commencementDate->subYears($legalAge);
    }
}
