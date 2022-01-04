<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PhoneNumberFix
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
        if ($request->input('phone')) {
            $phone = $request->input('phone');
            $phone = Str::remove('(', $phone);
            $phone = Str::remove(')', $phone);
            $phone = Str::remove(' ', $phone);
            $phone = Str::remove('-', $phone);
            $phone = Str::remove('+7', $phone);
            $request->merge(['phone' => $phone]);
        }
        if ($request->input('snils')) {
            $snils = $request->input('snils');
            $snils = Str::remove(' ', $snils);
            $snils = Str::remove('-', $snils);
            $request->merge(['snils' => $snils]);
        }
        return $next($request);
    }
}
