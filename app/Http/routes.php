<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', ['as' => 'index', 'uses' => 'Weather\IndexController@index']);
Route::get('/save-location', 'Weather\IndexController@saveLocation');
Route::get('/chooseLang', 'Weather\IndexController@chooseLang');

//Info routes
Route::get('/current-weather', 'Weather\IndexController@getCurrentWeatherAction');
Route::get('/current-date', 'Weather\IndexController@getCurrentDateAction');
Route::get('/current-city', 'Weather\IndexController@getCurrentLocationAction');
Route::get('/wind', 'Weather\IndexController@getWindAction');

Route::post('/forecast', 'Weather\IndexController@getForecastAction');