<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;

class SetLocale
{
    public function handle(Request $request, Closure $next): mixed
    {
        $locale = $request->segment(1);
        
        if (in_array($locale, ['ar', 'en'])) {
            App::setLocale($locale);
            Session::put('locale', $locale);
        } else {
            $locale = Session::get('locale', 'ar');
            App::setLocale($locale);
        }
        
        return $next($request);
    }
}
