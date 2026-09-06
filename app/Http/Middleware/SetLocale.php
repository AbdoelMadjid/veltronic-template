<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\Response;

class SetLocale
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $locale = null;
        if (Session::has('locale')) {
            $locale = Session::get('locale');
        } elseif ($request->hasCookie('kt_lang')) {
            $cookieLocale = $request->cookie('kt_lang');
            if (in_array($cookieLocale, ['en', 'id'], true)) {
                $locale = $cookieLocale;
                Session::put('locale', $locale);
            }
        }

        if ($locale && in_array($locale, ['en', 'id'], true)) {
            App::setLocale($locale);
        }

        return $next($request);
    }
}
