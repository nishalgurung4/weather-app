<?php

namespace App\Providers;

use App\Services\ExternalWeatherService;
use Illuminate\Support\ServiceProvider;

class ExternalWeatherServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(ExternalWeatherService::class, function () {
            return new ExternalWeatherService(config('weather.weather_forecast_url'));
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
