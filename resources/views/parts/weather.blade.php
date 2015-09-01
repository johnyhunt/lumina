<div class="container-fluid weather-fluid">
    <div class="container">
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 weather-block" style="background: rgba(0,0,0,0.5);">
            <div class="row">
                <div class="col-lg-9 col-md-9 col-sm-9 col-xs-9">
                    <h1 ng-bind="city"></h1>
                    <h2 style="margin: 15px 0 0 0" ng-bind="dateTime['time']"></h2>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
                    <h2 style="font-weight: bold" ng-bind="dateTime['day_name']"></h2>
                    <h4 style="color: #5bc0de">@{{dateTime['month']}}@{{dateTime['day']}}</h4>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                    <img src="img/icons/@{{icon}}.png" width="80px;">
                    <span style="font-size:36px; font-weight: bold;">@{{temperature}}&deg;</span>
                </div>

                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                    <h3 ng-bind="description"></h3>
                    <img src="img/wind.png" alt="" width="60px;">
                    <span style="font-size:22px; font-weight: bold;">@{{wind['speed']}}mph</span>
                </div>
            </div>
        </div>

        <div class="weather-block col-lg-6 col-md-6 col-sm-6 col-xs-12" style="background: rgba(0,0,0,0.8);">
            <div style="margin: 15px 30px 54px 30px">
                <div class = "col-lg-3 col-md-3 col-sm-3 col-xs-3" ng-repeat="val in forecast">
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