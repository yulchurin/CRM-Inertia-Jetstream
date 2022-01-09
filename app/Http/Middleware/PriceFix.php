<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PriceFix
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
        if ($request->input('base_price')) {

            $basePrice = $request->input('base_price');
            $basePrice = Str::remove(' ', $basePrice);
            $basePrice = Str::remove('₽', $basePrice);
            $basePrice = Str::remove('коп', $basePrice);

            $request->merge(['base_price' => $basePrice]);
        }

        if ($request->input('price_per_driving_hour')) {

            $price = $request->input('price_per_driving_hour');
            $price = Str::remove(' ', $price);
            $price = Str::remove('₽', $price);
            $price = Str::remove('коп', $price);

            $request->merge(['price_per_driving_hour' => $price]);
        }

        return $next($request);
    }
}
