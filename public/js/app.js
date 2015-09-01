'use strict';

/**
 * Main angular module
 */
angular.module("lmnApp",[]).factory('weatherService', function ($http) {
    return {
        getWeather : function(city) {
            return $http.get('http://api.openweathermap.org/data/2.5/weather', {
                params: {
                    q: city
                }
            }).then(function(response) {
                return "Desc: " + response.data.weather[0].description + ", Temp: " + (response.data.main.temp - 273).toFixed() + "°C";
            })
        }
    }
});

//JQuery Part
$(document).ready(function() {

    var currentDate = new Date();
    var hours = currentDate.getHours();

    if (hours > 18 || (hours > 0 && hours < 6)) {
        $(".weather-fluid").css("background", "url('../img/europe-night.jpg')");
    }
});