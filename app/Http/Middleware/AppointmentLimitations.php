<?php

namespace App\Http\Middleware;

use App\Models\Appointment;
use App\Services\LimitAppointment;
use Closure;
use Illuminate\Http\Request;

class AppointmentLimitations
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if (LimitAppointment::weekly()) {
            return back()->with('message', 'Вы израсходовали недельный лимит');
        }

        if (LimitAppointment::daily()) {
            return back()->with('message', 'Вы израсходовали дневной лимит');
        }

        return $next($request);
    }
}
