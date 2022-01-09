<?php

namespace App\Models;

use App\Traits\UserActive;
use App\Traits\UserRoles;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Storage;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;

/**
 * @property integer role
 * @property boolean active
 * @property integer group_id
 * @property string google_id
 * @property string vk_id
 * @property string phone
 */
class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;
    use SoftDeletes;
    use UserRoles, UserActive;

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
        'role',
        'phone',
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
        'role' => 'integer'
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'profile_photo_url',
        'permissions',
    ];

    /**
     * Permissions Scope
     *
     * @return Attribute
     */
    protected function permissions(): Attribute
    {
        return new Attribute(
            get: fn() => [
                'users' => [
                    'index' => $this->can('viewAny', User::class),
                    'view' => $this->can('view', [$this, User::class]),
                    'create' => $this->can('create', User::class),
                    'update' => $this->can('update', [$this, User::class]),
                    'delete' => $this->can('delete', [$this, User::class]),
                ],
            ]
        );
    }

    /**
     * Hack for Socialite user avatars...
     *
     * @return mixed
     */
    public function getProfilePhotoUrlAttribute(): mixed
    {
        $path = $this->profile_photo_path;

        if (Storage::disk($this->profilePhotoDisk())->exists($path)){
            return Storage::disk($this->profilePhotoDisk())->url($this->profile_photo_path);
        } elseif (!empty($path)) {
            // Use Photo URL from Social sites link...
            return $path;
        } else {
            //empty path. Use defaultProfilePhotoUrl
            return $this->defaultProfilePhotoUrl();
        }
    }

    /**
     * Determines whether user logged in using social networks
     *
     * @return bool
     */
    public function isSocialiteUser(): bool
    {
        return $this->vk_id || $this->google_id;
    }

    /**
     * Instructor or Student has many
     *
     * @return HasMany
     */
    public function appointments(): HasMany
    {
        return $this->hasMany(Appointment::class);
    }
}
