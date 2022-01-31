<?php

namespace App\Providers;

use App\Models\Appointment;
use App\Models\User;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\User' => 'App\Policies\UserPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('update-appointment', function (User $user, Appointment $appointment) {
            return $user->id === $appointment->student_id ||
                $appointment->student_id === null;
        });

        Gate::after(function ($user, $ability, $result, $arguments) {
            if ($user->isOwner()) {
                return true;
            }
        });
    }
}
