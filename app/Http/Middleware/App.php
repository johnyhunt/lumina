<?php
/**
 * Created by PhpStorm.
 * User: John
 * Date: 20.07.2015
 * Time: 18:44
 */

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Session;


class App {

    /**
     * The available languages.
     *
     * @array $languages
     */
    protected $languages = ['ru','en'];

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next) {
        if(!Session::has('locale'))  {
            Session::put('locale', $request->getPreferredLanguage($this->languages));
        }

        \App::setLocale(\Session::get("locale"));

        return $next($request);
    }
}