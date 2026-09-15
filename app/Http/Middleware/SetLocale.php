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
        $cookieLocale = null;
        if ($request->hasCookie('kt_lang') && in_array($request->cookie('kt_lang'), ['en', 'id'], true)) {
            $cookieLocale = $request->cookie('kt_lang');
        } elseif (isset($_COOKIE['kt_lang']) && in_array($_COOKIE['kt_lang'], ['en', 'id'], true)) {
            $cookieLocale = $_COOKIE['kt_lang'];
        } elseif ($request->hasCookie('data-kt-lang') && in_array($request->cookie('data-kt-lang'), ['en', 'id'], true)) {
            $cookieLocale = $request->cookie('data-kt-lang');
        } elseif (isset($_COOKIE['data-kt-lang']) && in_array($_COOKIE['data-kt-lang'], ['en', 'id'], true)) {
            $cookieLocale = $_COOKIE['data-kt-lang'];
        }

        $sessionLocale = Session::get('locale');
        $defaultDbLocale = null;
        try {
            if (class_exists(\App\Models\AppSupport\AppSetting::class)) {
                $defaultDbLocale = \App\Models\AppSupport\AppSetting::get('default_language');
            }
        } catch (\Throwable $e) {
            // fallback
        }

        // Prefer active client cookie if present, fallback to session, then database default, then config
        $locale = $cookieLocale ?: ($sessionLocale ?: ($defaultDbLocale ?: config('app.locale', 'id')));

        if ($locale && in_array($locale, ['en', 'id'], true)) {
            App::setLocale($locale);
            if (!Session::has('locale') || Session::get('locale') !== $locale) {
                Session::put('locale', $locale);
            }
            \Illuminate\Support\Facades\Cookie::queue('kt_lang', $locale, 525600);
            \Illuminate\Support\Facades\Cookie::queue('data-kt-lang', $locale, 525600);
        }

        return $next($request);
    }
}
