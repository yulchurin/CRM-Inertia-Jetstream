<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class ManagementRoutesMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return mixed|void
     */
    public function handle(Request $request, Closure $next)
    {
        if (Auth::user()->isOwner() || Auth::user()->isAdmin()) {
            return $next($request);
        }

        abort(403);
    }
}
