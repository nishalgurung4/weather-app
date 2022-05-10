<?php

namespace App\Listeners;

use App\Events\NoWeatherFound;
use App\Jobs\FetchWeather;
use App\Models\City;
use App\Models\Weather;
use App\Services\ExternalWeatherService;
use Exception;
use Illuminate\Support\Facades\Log;

class FetchWeatherFromApi
{
    /**
     * Instance of ExternalWeatherService
     * @var ExternalWeatherService
     */
    private ExternalWeatherService $weather;

    /**
     * Get instance from the service container
     *
     * @return void
     */
    public function __construct(ExternalWeatherService $weather)
    {
        $this->weather = $weather;
    }

    /**
     * Handle the event.
     *
     * @return void
     */
    public function handle(NoWeatherFound $event)
    {
        City::each(function ($city) use ($event) {
            if ($event->async) {
                FetchWeather::dispatch($city);
            } else {
                try {
                    Weather::insert($this->weather->getWeathers($city->name)->format());
                } catch (Exception $e) {
                    Log::error("Insertion Error of ".$city->name." due to ".$e->getMessage());
                }
            }
        });
    }
}
