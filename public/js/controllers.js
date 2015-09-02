/**
 * Angular controller
 */
angular.module("lmnApp").controller("MainController", ["$scope", "$http", "$window", "weatherService",
    function ($scope, $http, $window, weatherService) {

        //Create function for our service
        $scope.weatherService = function () {
            $scope.weatherDescription = "Fetching . . .";
            weatherService.getWeather($scope.jscity).then(function (data) {
                $scope.weatherDescription = data;
            }, function () {
                $scope.weatherDescription = "Could not obtain data";
            })
        };

        //Get our geo location
        if (navigator.geolocation) {
            $window.navigator.geolocation.getCurrentPosition(function (position) {
                $scope.$apply(function () {
                    var latitude = position["coords"]["latitude"];
                    var longitude = position["coords"]["longitude"];
                    $http({
                        url: "/save-location",
                        method: "GET",
                        params: {latitude: latitude, longitude: longitude},
                        cache: true
                    })
                });
            }, function (error) {
                console.log(error);
            }, {timeout: 10000000, enableHighAccuracy: true, maximumAge: 0});
        }

        //Five days weather
        $http.post('/forecast').success(function (response) {
            $scope.forecast = response;
        });

        //Here we will get all need information
        //Today's weather
        $http.get('/current-weather').success(function (response) {
            $scope.temperature = response["temp"];
            $scope.icon = response["icon"];
            $scope.description = response["desc"];
        });

        //Today's day
        $http.get('/current-date').success(function (response) {
            $scope.dateTime = response;
        });

        //Current city
        $http.get('/current-city').success(function (response) {
            $scope.city = response;
        });

        //Wind
        $http.get('/wind').success(function (response) {
            $scope.wind = response;
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
                body: "Lorem Ipsum is simply dummy text of the printing and typesetting industry. " +
                "Lorem Ipsum has been the industry's standard dummy text ever since the 1500s," +
                "when an unknown printer took a galley of type and scrambled it to make a type specimen book. " +
                "It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. " +
                "It was popularised in the 1960s",
                img: "img/img1.jpg"
            },
            {
                id: 1,
                title: "Lumina Forecast",
                body: "Lorem Ipsum is simply dummy text of the printing and typesetting industry. " +
                "Lorem Ipsum has been the industry's standard dummy text ever since the 1500s," +
                "when an unknown printer took a galley of type and scrambled it to make a type specimen book. " +
                "It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. " +
                "It was popularised in the 1960s",
                img: "img/img2.jpg"
            },
            {
                id: 2,
                title: "Features & Analysis",
                body: "Lorem Ipsum is simply dummy text of the printing and typesetting industry. " +
                "Lorem Ipsum has been the industry's standard dummy text ever since the 1500s," +
                "when an unknown printer took a galley of type and scrambled it to make a type specimen book. " +
                "It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. " +
                "It was popularised in the 1960s",
                img: "img/img3.jpg"
            }
        ];

        //Forecast videos
        //Also in simple JSON
        $scope.videos = [
            {
                id: 0,
                url: "http://www.youtube.com/watch?v=RQ5ljyGg-ig",
                img: "img/video1.jpg"
            },
            {
                id: 1,
                url: "http://www.youtube.com/watch?v=RQ5ljyGg-ig",
                img: "img/video2.jpg"
            },
            {
                id: 2,
                url: "http://www.youtube.com/watch?v=RQ5ljyGg-ig",
                img: "img/video3.jpg"
            }
        ]
    }]);