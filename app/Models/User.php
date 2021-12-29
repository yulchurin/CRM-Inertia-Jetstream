<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasOneThrough;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;
use Laratrust\Traits\LaratrustUserTrait;

class User extends Authenticatable
{
    use LaratrustUserTrait;
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
        'profile_photo_path',
        'vk_id',
        'google_id',
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
        'active' => 'boolean',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'profile_photo_url',
        'permissions',
        'person'
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
     * Certificate relation
     *
     * @return HasOne
     */
    public function certificate(): HasOne
    {
        return $this->hasOne(Certificate::class);
    }

    /**
     * @return BelongsTo
     */
    public function group(): BelongsTo
    {
        return $this->belongsTo(Group::class);
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
        return false;
        //
    }

    /**
     * Check user's role: Assistant or Not
     *
     * @return boolean
     */
    public function isAssistant(): bool
    {
        return false;
        //
    }

    /**
     * Permissions Scope
     *
     * @return array
     */
    public function getPermissionsAttribute(): array
    {
        return [
            'users' => [
                'index' => $this->can('viewAny', User::class),
                'view' => $this->can('view', [$this, User::class]),
                'create' => $this->can('create', User::class),
                'update' => $this->can('update', [$this, User::class]),
                'delete' => $this->can('delete', [$this, User::class]),
            ],
        ];
    }

    public function getPersonAttribute()
    {
        //
    }
}
