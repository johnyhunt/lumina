<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Cache;

class LuminaWeather_API extends Model {

    /**
     * @var int
     */
    protected $longitude;

    /**
     * @var int
     */
    protected $latitude;

    /**
     * @var array
     */
    protected $weatherToday;

    /**
     * @var array
     */
    protected $forecast;

    /**
     * @var array
     */
    protected $location;

    /**
     * All initial data will be here
     *
     * @param $longitude
     * @param $latitude
     */
    public function __init($longitude, $latitude) {
        $this->longitude = $longitude;
        $this->latitude = $latitude;

        $this->weatherToday = json_decode(file_get_contents("http://api.openweathermap.org/data/2.5/weather?lat=$latitude&lon=$longitude"), true);
        $this->forecast = json_decode(file_get_contents("http://api.openweathermap.org/data/2.5/forecast?lat=$latitude&lon=$longitude"), true);
        $this->location = json_decode(file_get_contents("http://maps.googleapis.com/maps/api/geocode/json?latlng=$latitude,$longitude&sensor=true"), true);

        Cache::add("weather", $this->weatherToday, 60);
        Cache::add("forecast", $this->forecast, 60);
        Cache::add("location", $this->location, 60);
    }

    /**
     * Get current temperature and icon
     *
     * @return array
     */
    public function getIconTemperature() {
        if(empty($this->weatherToday)) {
            $this->weatherToday = Cache::get("weather");
        }

        $tempValue = round($this->weatherToday["main"]["temp"] - 273);
        $icon = $this->weatherToday["weather"][0]["icon"];
        $description = $this->weatherToday["weather"][0]["description"];

        return array("temp" => $tempValue, "icon" => $icon, "desc" => $description);
    }

    /**
     * Get information about today's wind
     *
     * @return array
     */
    public function getWindInfo() {
        if(empty($this->weatherToday)) {
            $this->weatherToday = Cache::get("weather");
        }
        $windSpeed = $this->weatherToday["wind"]["speed"];
        $windDegree = $this->weatherToday["wind"]["deg"];
        return array("speed" => $windSpeed, "deg" => $windDegree);
    }

    /**
     * Get all info about current date
     */
    public function getCurrentDateInfo () {
        $allDateInfo = array();
        $allDateInfo["time"] = date("h:i A");
        $allDateInfo["day"] = date("d");
        $allDateInfo["day_name"] = date('D', strtotime( date("Y-m-d")));
        $allDateInfo["month"] = date('M', strtotime( date("Y-m-d")));

        return $allDateInfo;
    }

    /**
     * Get full location
     *
     * @return array
     */
    public function getFullLocationInfo () {
        if(empty($this->location)) {
            return Cache::get("location");
        }
        return $this->location;
    }


    /**
     * Get city with location
     *
     * @return string
     */
    public function getCity () {
        if(empty($this->location)) {
            $this->location = Cache::get("location");
        }

        $allLocation = $this->location["results"];

        foreach($allLocation as $val) {
            if ($val["types"][0] == "street_address" || $val["types"][0] == "route") {
                foreach($val["address_components"] as $city) {
                    if ($city["types"][0] == "locality" || $city["types"][0] == "administrative_area_level_1") {
                        return $city["long_name"];
                    }
                }
            }
        }
        return "London"; //Ass default
    }

    /**
     * Get weather for five days
     *
     * @return array
     */
    public function getFiveDaysWeather() {
        $resultForecast = array();
        $result = array();
        if(empty($this->forecast)) {
            $this->forecast = Cache::get("forecast");
        }

        $forecast = $this->forecast["list"];
        $startDate = date("Y-m-d", strtotime(date("Y-m-d") . ' +1 day'));

        //Choose only need time data
        foreach($forecast as $val) {
            $needTime = $startDate." 12:00:00";
            if ($val["dt_txt"] == $needTime) {
                $resultForecast[] = $val;
                $startDate = date("Y-m-d", strtotime($startDate . ' +1 day'));
            }
        }

        $day = date('D', strtotime( date("Y-m-d")));

        //Prepare only need data
        foreach($resultForecast as $val) {
            $tempMin = round($val["main"]["temp_min"] - 273);
            $tempMax = round($val["main"]["temp_max"] - 273);
            $day = date('D', strtotime($day . ' +1 day'));
            $icon = $val["weather"][0]["icon"];
            $result[] = array("min" => $tempMin, "max" => $tempMax, "day" => $day, "icon" => $icon);
        }

        return $result;
    }
}
