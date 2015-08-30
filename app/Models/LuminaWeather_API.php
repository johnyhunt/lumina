<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LuminaWeather_API extends Model {

    public function init() {
        //dd($_SERVER);
        $user_ip = getenv('REMOTE_ADDR');
        $geo = unserialize(file_get_contents("http://www.geoplugin.net/php.gp?ip=$user_ip"));
        //$country = $geo["geoplugin_countryName"];
        //$city = $geo["geoplugin_city"];

        dd($geo);

        //
        //dd(file_get_contents("http://api.openweathermap.org/data/2.5/weather?q=London"));
    }


}
