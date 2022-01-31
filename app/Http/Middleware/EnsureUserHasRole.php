<?php

namespace App\Http\Middleware;

use App\Interfaces\UserRole;
use Closure;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class EnsureUserHasRole
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @param string $role
     * @return Response|RedirectResponse
     */
    public function handle(Request $request, Closure $next, string $role)
    {
        if ($role === 'owner' && ! Auth::user()->isOwner()) {
            abort(403);
        }

        if ($role === 'admin' && ! Auth::user()->isAdmin()) {
            abort(403);
        }

        if ($role === 'instructor' && ! Auth::user()->isInstructor()) {
            abort(403);
        }

        if ($role === 'teacher' && ! Auth::user()->isTeacher()) {
            abort(403);
        }

        if ($role === 'enrollee' && ! Auth::user()->isEnrollee()) {
            abort(403);
        }

        if ($role === 'student' && ! Auth::user()->isStudent()) {
            abort(403);
        }

        if ($role === 'graduated' && ! Auth::user()->isGraduated()) {
            abort(403);
        }

        if ($role === 'client' && ! Auth::user()->isClient()) {
            abort(403);
        }

        return $next($request);
    }
}
