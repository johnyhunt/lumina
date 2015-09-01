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
    {!! HTML::style('css/font.css') !!}

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

    <div class="container-fluid weather-fluid">
        <div class="container">
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12" style="background: rgba(0,0,0,0.5); margin-top:-10px; padding: 10px;">
                <div>
                    <div style="float: right; margin: 0 10px 0 0 ">
                        <h2 style="font-weight: bold" ng-bind="dateTime['day_name']"></h2>
                        <h4 style="color: #5bc0de">@{{dateTime['month']}}@{{dateTime['day']}}</h4>
                    </div>
                    <div style="margin: 20px;">
                        <h1 ng-bind="city"></h1>
                        <h2 style="margin: 15px 0 0 0" ng-bind="dateTime['time']"></h2>
                    </div>
                </div>

                <div style="float: left;">
                    <img src="img/icons/@{{icon}}.png" width="80px;">
                    <span style="font-size:42px; font-weight: bold;">@{{temperature}}&deg;</span>
                </div>

                <div style="float: left; margin: 10px 0 0 100px;">
                    <h2>Sky is clear</h2>
                    <img src="img/wind.png" alt="" width="60px;">
                    <span style="font-size:22px; font-weight: bold;">5mph</span>
                </div>
            </div>

            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12" style="background: rgba(0,0,0,0.8); margin-top:-10px; padding: 10px;">
                <div style="margin: 15px 30px 54px 30px">
                    <div style="float: left; margin: 10px 25px;" ng-repeat="val in forecast">
                        <h3 ng-bind="val['day']"></h3>
                        <img src="img/icons/@{{val['icon']}}.png" height="42px">
                        <h3>@{{val['max']}}&deg;</h3>
                        <h3>@{{val['min']}}&deg;</h3>
                    </div>
                    <div style="clear: both"></div>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-lg-4 col-sm-6 col-xs-12" ng-repeat="val in news">
                <div class="thumbnail">
                    <div class="caption">
                        <img src="img/@{{val['img']}}">
                        <h3 ng-bind="val['title']"></h3>
                        <p class="text-justify" ng-bind="val['body']"></p>
                        <p><a href="#" class="btn btn-primary">Read More</a></p>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="row" style="margin: 20px 0">
            <img src="img/footer.jpg" width="100%">
        </div>
    </div>

    <div class="container-fluid footer">
        <div class="container">
            <div style="margin: 15px 0">
                <img src="img/luminalogo.png">
                © 2015  Privacy policy
            </div>
        </div>
    </div>

</body>
    <!--Inline scripts-->
{!! HTML::script('js/app.js') !!}
</html>