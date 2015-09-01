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

angular.module("lmnApp").controller("MainController", ["$scope", "$http", "$cacheFactory", "weatherService", function($scope, $http, $cacheFactory, weatherService) {

    $scope.weatherService = function () {
        $scope.weatherDescription = "Fetching . . .";
        weatherService.getWeather($scope.jscity).then(function (data) {
            $scope.weatherDescription = data;
        }, function() {
            $scope.weatherDescription = "Could not obtain data";
        })
    };

    //Get our geo location
    var cache = $cacheFactory('cordCache');

    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(function(position){
            $scope.$apply(function(){
                var latitude = position["coords"]["latitude"];
                var longitude = position["coords"]["longitude"];
                $http({
                    url: "/save-location",
                    method: "GET",
                    params: {latitude: latitude, longitude: longitude},
                    cache: true
                })
            });
        });
    }

    //Here we will get all need information
    //Today's weather
    $http.get('/current-weather').success(function (response) {
        $scope.temperature = response["temp"];
        $scope.icon = response["icon"];
    });

    //Today's day
    $http.get('current-date').success(function(response) {
        $scope.dateTime = response;
    });

    //Current city
    $http.get('current-city').success(function(response) {
        $scope.city = response;
    });

    //Five days weather
    $http.post('/forecast').success(function(response) {
        $scope.forecast = response;
    });

    //Weather news
    //In real projects, all news(records) will have to be in database(s)
    //And will be such note
    //$http.get('url', {config})...
    //
    //But for this exercise, I wrote news in simple JSON
    $scope.news = [
        {
            id: 0,
            title: "Lumina Weather",
            body:  "Lorem Ipsum is simply dummy text of the printing and typesetting industry. " +
            "Lorem Ipsum has been the industry's standard dummy text ever since the 1500s," +
            "when an unknown printer took a galley of type and scrambled it to make a type specimen book. " +
            "It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. " +
            "It was popularised in the 1960s",
            img: "img1.jpg"
        },
        {
            id: 1,
            title: "Lumina Forecast",
            body:  "Lorem Ipsum is simply dummy text of the printing and typesetting industry. " +
            "Lorem Ipsum has been the industry's standard dummy text ever since the 1500s," +
            "when an unknown printer took a galley of type and scrambled it to make a type specimen book. " +
            "It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. " +
            "It was popularised in the 1960s",
            img: "img2.jpg"
        },
        {
            id: 2,
            title: "Features & Analysis",
            body:  "Lorem Ipsum is simply dummy text of the printing and typesetting industry. " +
            "Lorem Ipsum has been the industry's standard dummy text ever since the 1500s," +
            "when an unknown printer took a galley of type and scrambled it to make a type specimen book. " +
            "It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. " +
            "It was popularised in the 1960s",
            img: "img3.jpg"
        }
    ];
}]);

//JQuery Part
$(document).ready(function() {

    var currentDate = new Date();
    var hours = currentDate.getHours();

    if (hours > 18 || (hours > 0 && hours < 6)) {
        $(".weather-fluid").css("background", "url('../img/europe-night.jpg')");
    }
});