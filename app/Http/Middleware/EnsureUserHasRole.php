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
        abort_if($role === 'owner' && !auth()->user()->isOwner(), 403);
        abort_if($role === 'admin' && !auth()->user()->isAdmin(), 403);
        abort_if($role === 'instructor' && !auth()->user()->isInstructor(), 403);
        abort_if($role === 'teacher' && !auth()->user()->isTeacher(), 403);
        abort_if($role === 'enrollee' && !auth()->user()->isEnrollee(), 403);
        abort_if($role === 'student' && !auth()->user()->isStudent(), 403);
        abort_if($role === 'graduated' && !auth()->user()->isGraduated(), 403);
        abort_if($role === 'client' && !auth()->user()->isClient(), 403);

        return $next($request);
    }
}
