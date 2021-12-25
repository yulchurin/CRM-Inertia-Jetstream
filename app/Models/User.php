<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasOneThrough;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;
use App\Models\Role;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'profile_photo_url',
    ];

    /**
     * User has a Person
     *
     * @return HasOne
     */
    public function person(): HasOne
    {
        return $this->hasOne(Person::class);
    }

    /**
     * User has a Paper
     *
     * @return HasOneThrough
     */
    public function paper(): HasOneThrough
    {
        return $this->hasOneThrough(Paper::class, Person::class);
    }

    /**
     * User has a Person
     *
     * @return HasOne
     */
    public function legalRepresentative(): HasOne
    {
        return $this->hasOne(LegalRepresentative::class);
    }

    /**
     * Returns parent's or legal representative's personality
     *
     * @return HasOneThrough
     */
    public function legalRepresentativePerson(): HasOneThrough
    {
        return $this->hasOneThrough(Person::class, LegalRepresentative::class)->with('paper');
    }

    /**
     * Scope a query to only include active users.
     *
     * @param Builder $query
     * @return void
     */
    public function scopeActive(Builder $query): void
    {
        $query->where('active', true);
    }

    /**
     * Check user's role: Admin or Not
     *
     * @return boolean
     */
    public function isAdmin(): bool
    {
        return Auth::user()->role === Role::ADMIN;
    }

    /**
     * Check user's role: Assistant or Not
     *
     * @return boolean
     */
    public function isAssistant(): bool
    {
        return Auth::user()->role === Role::ASSISTANT;
    }
}
