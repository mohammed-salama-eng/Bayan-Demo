<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Symfony\Component\HttpFoundation\Response;

class SetLocale
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if ($request->user() && in_array($request->user()->locale, ['en', 'ar'])) {
            App::setLocale($request->user()->locale);
        } elseif ($request->session()->has('locale') && in_array($request->session()->get('locale'), ['en', 'ar'])) {
            App::setLocale($request->session()->get('locale'));
        }

        return $next($request);
    }
}
