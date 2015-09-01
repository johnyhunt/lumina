@extends('app')

@section('title')
    Lumina Weather Responsive Website
@stop

@section('content')
<div class="container">
    <div class="page-header">
        <h2>Latest lumina weather news</h2>
    </div>

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
@stop