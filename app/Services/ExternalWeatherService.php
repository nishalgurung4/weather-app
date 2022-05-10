<?php

namespace App\Services;

use App\Models\City;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Http;

class ExternalWeatherService
{
    /**
     * Api url
     * @var string
     */
    protected string $url;
    /**
     * Response from the api
     * @var array|object
     */
    private array|object $data;
    /**
     * Instance of City model
     * @var City
     */
    private City $city;

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
        $this->city = City::where('name', $city)->first();
        $this->data = $this->getData(['q' => $city]);
        return $this;
    }

    /**
     * @param $options
     * @return array|object
     */
    public function getData($options): array|object
    {
        return (Http::get($this->url, array_merge($options, ['appid' => config('weather.open_weather_map_api_key')])))->object();
    }

    public function format(): array
    {
        $forecast = [];
        foreach ($this->data->list as $weather) {
            $forecast[] = [
                'city_id' => $this->city->id,
                'condition' => $weather->weather[0]->main,
                'description' => $weather->weather[0]->description,
                'temperature' => $weather->main->temp,
                'humidity_percent' => $weather->main->humidity,
                'pressure' => $weather->main->pressure,
                'min_temperature' => $weather->main->temp_min,
                'max_temperature' => $weather->main->temp_max,
                'visibility_in_meter' => $weather->visibility,
                'wind_speed' => $weather->wind->speed ?? 0,
                'wind_degree' => $weather->wind->deg ?? 0,
                'cloudiness_percent' => $weather->clouds->all,
                'rain_for_3_hour' => $weather->rain->{'3h'} ?? 0,
                'snow_for_3_hour' => $weather->snow->{'3h'} ?? 0,
                'time_of_data_calculation' => $weather->dt_txt,
                'date' => Carbon::now(),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ];
        }
        return $forecast;
    }
}
