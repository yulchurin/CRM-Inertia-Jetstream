<?php

namespace App\Providers;

use App\Http\Resources\PaperResource;
use App\Http\Resources\PersonResource;
use App\Http\Resources\ScheduleCollection;
use App\Http\Resources\ScheduleResource;
use App\Http\Resources\UserCollection;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\ServiceProvider;
use Inertia\Inertia;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        if ($this->app->environment('production')) {
            URL::forceScheme('https');
        }

        PersonResource::withoutWrapping();
        PaperResource::withoutWrapping();
        UserCollection::withoutWrapping();
        ScheduleResource::withoutWrapping();
        ScheduleCollection::withoutWrapping();

        Inertia::share([
            'errors' => function () {
                return Session::get('errors')
                    ? Session::get('errors')->getBag('default')->getMessages()
                    : (object) [];
            },
        ]);

        Inertia::share('flash', function () {
            return [
                'message' => Session::get('message'),
                'status' => Session::get('status'),
            ];
        });
    }
}
