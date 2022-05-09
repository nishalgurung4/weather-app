<?php

namespace App\Listeners;

use App\Events\NoWeatherFound;
use App\Jobs\FetchWeather;
use App\Models\City;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class FetchWeatherFromApi
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
    }

    /**
     * Handle the event.
     *
     * @param  NoWeatherFound  $event
     * @return void
     */
    public function handle(NoWeatherFound $event)
    {
        City::each(function ($city) {
            FetchWeather::dispatch($city);
        });
    }
}
