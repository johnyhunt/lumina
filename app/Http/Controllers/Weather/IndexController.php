<?php

namespace App\Http\Controllers\Weather;

use Illuminate\Http\Request;
use Illuminate\Http\Response;

use App\Http\Requests;

use App\Http\Controllers\Controller;
use App\Models\LuminaWeather_API;
use Cache;
use Carbon\Carbon;

class IndexController extends Controller {

    /**
     * @var LuminaWeather_API
     */
    private $api;

    /**
     * Constructor
     */
    public function __construct() {
        $this->api = new LuminaWeather_API();
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index() {
        $api = new LuminaWeather_API();
        $latitude = Cache::get("latitude");
        $longitude = Cache::get("longitude");
        $api->__init($longitude, $latitude);

        return view ("index.index");
    }

    /**
     * Get location and save/cache it
     */
    public function saveLocation (Request $request) {
        $expiresAt = Carbon::now()->addMinutes(60);
        Cache::add('latitude', $request->input("latitude"), $expiresAt);
        Cache::add('longitude', $request->input("longitude"), $expiresAt);
        return "200 OK";
    }

    /**
     * Get current weather. Can use in any part of project
     */
    public function getCurrentWeatherAction() {
        return $this->api->getIconTemperature();
    }

    /**
     * Get current date. Can use in any part of project
     */
    public function getCurrentDateAction() {
        return $this->api->getCurrentDateInfo();
    }

    /**
     * Get city location. Can use in any part of project
     */
    public function getCurrentLocationAction() {
        return $this->api->getCity();
    }

    /**
     * Get five days weather
     */
    public function getForecastAction () {
        return $this->api->getFiveDaysWeather();
    }

    /**
     * Get wind information
     */
    public function getWindAction() {
        return $this->api->getWindInfo();
    }

    /**
     * Choose lang
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function chooseLang(Request $request) {
        \Session::set('locale', $request->get("lang"));
        return redirect()->back();
    }
}
