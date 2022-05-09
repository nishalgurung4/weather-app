<?php

use Illuminate\Support\Facades\Facade;

return [

    /*
    |--------------------------------------------------------------------------
    | Application Name
    |--------------------------------------------------------------------------
    |
    | This value is the name of your application. This value is used when the
    | framework needs to place the application's name in a notification or
    | any other location as required by the application or its packages.
    |
    */

    'open_weather_map_api_key' => env('OPEN_WEATHER_MAP_API_KEY', ''),
    'weather_forecast_url' => 'https://api.openweathermap.org/data/2.5/forecast'

];
