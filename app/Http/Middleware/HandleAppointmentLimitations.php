<?php

namespace App\Http\Middleware;

use App\Services\AppointmentLimitations;
use Closure;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class HandleAppointmentLimitations
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return Response|RedirectResponse
     */
    public function handle(Request $request, Closure $next): Response|RedirectResponse
    {
        if (AppointmentLimitations::allottedTime()) {
            return back()->with('message', 'Вы израсходовали все доступные занятия');
        }

        if (AppointmentLimitations::weekly()) {
            return back()->with('message', 'Вы израсходовали недельный лимит');
        }

        if (AppointmentLimitations::daily()) {
            return back()->with('message', 'Вы израсходовали дневной лимит');
        }

        if (AppointmentLimitations::payment()) {
            return back()->with('message', 'На Вашем счёте недостаточно денег для бронирования уроков');
        }

        return $next($request);
    }
}
