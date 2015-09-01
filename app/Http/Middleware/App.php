<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Session;


class App {

    /**
     * The available languages.
     *
     * @array $languages
     */
    protected $languages = ['en','ru'];

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next) {
        if(!Session::has('locale'))  {
            Session::put('locale', 'en');
        }

        \App::setLocale(\Session::get("locale"));

        return $next($request);
    }
}