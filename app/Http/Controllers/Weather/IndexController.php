<?php

namespace App\Http\Controllers\Weather;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\LuminaWeather_API;

class IndexController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index() {
        $api = new LuminaWeather_API();
        $api->init();
        return view ("index.index");
    }
}
