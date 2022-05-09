<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class ExternalWeatherService
{
    protected string $url;

    /**
     * Constructor Dependency Injection
     *
     * @param  string  $url
     * @return void
     */
    public function __construct(string $url)
    {
        $this->url = $url;
    }

    /**
     * To retrieve weather
     * @param $city
     * @return array|object
     */
    public function getWeathers($city): object|array
    {
        return $this->getData(['q' => $city]);
    }

    /**
     * @param $options
     * @return array|object
     */
    public function getData($options): array|object
    {
        return (Http::get($this->url, array_merge($options, ['appid' => config('weather.open_weather_map_api_key')])))->object();
    }
}
