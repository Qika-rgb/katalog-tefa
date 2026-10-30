<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;

class SetLocale
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next)
    {
        // Ambil bahasa dari session atau default 'id'
        $locale = Session::get('locale', config('app.locale', 'id'));

        // Pastikan hanya locale yang didukung
        if (in_array($locale, ['id', 'en'])) {
            App::setLocale($locale);
        } else {
            App::setLocale('id');
        }

        return $next($request);
    }
}

