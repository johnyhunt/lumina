<!DOCTYPE html>
<html lang="en" ng-app="lmnApp">
<head>
    <title>Lumina Weather Responsive Website</title>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <!--CSS libs/files-->
    {!! HTML::style('css/bootstrap/bootstrap.css') !!}
    {!! HTML::style('css/style.css') !!}
    {!! HTML::style('css/navbar.css') !!}

    <!--JS libs-->
    {!! HTML::script('js/lib/jquery/jquery-2.1.4.js')!!}
    {!! HTML::script('js/lib/bootstrap/bootstrap.js') !!}
    {!! HTML::script('js/lib/angular/angular-1.4.4.js') !!}
</head>

<body ng-controller="MainController">
    <!--Start bootstrap container-->
    <div class="container">
        <!--Header-->
        @include("parts.header")

        <div class="row" >
            <div class="col-lg-6 col-md-9 col-sm-8">
                <div class="form-group">
                    <input type="text" class="form-control" id="weather" placeholder="Enter city name here" ng-model="jscity">
                </div>
            </div>

            <div class="col-lg-6 col-md-3 col-sm-4">
                <button class="btn btn-info btn-circle" style="float: left" ng-click="weatherService()">+</button>
                <h2 class="add-location">Add location</h2>
            </div>
        </div>

        <div class="row" style="margin: 0 0 10px 10px">
            <h4 ng-bind="weatherDescription"></h4>
        </div>

        <div class="row" style="margin: 40px 0 10px 0">
            <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                <h2>Daily Weather Forecast Videos</h2>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-4 col-xs-12">
                <img src="img/video1.jpg">
            </div>
            <div class="col-lg-3 col-md-3 col-sm-4 col-xs-12">
                <img src="img/video2.jpg">
            </div>
            <div class="col-lg-3 col-md-3 col-sm-4 col-xs-12">
                <img src="img/video3.jpg">
            </div>
        </div>
    </div>

    @include("parts.weather")

    @yield("content")

    @include("parts.footer")

</body>
    <!--Inline scripts-->
{!! HTML::script('js/app.js') !!}
{!! HTML::script('js/controllers.js') !!}
</html>