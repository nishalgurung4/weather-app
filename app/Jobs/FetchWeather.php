<?php

namespace App\Jobs;

use App\Models\City;
use App\Models\Weather;
use App\Services\ExternalWeatherService;
use Exception;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Log;

class FetchWeather implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * The city instance
     * @var City
     */
    protected City $city;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(City $city)
    {
        $this->city = $city;
    }

    /**
     * Execute the job.
     * Using insert() instead of create() for the performance
     * @return void
     */
    public function handle(ExternalWeatherService $weather)
    {
        try {
            Weather::insert($this->parseForecastResponse($weather->getWeathers($this->city->name)));
        } catch (Exception $e) {
            Log::error("Insertion Error of ".$this->city->name);
        }
    }

    /**
     * Format api response
     * @param  object|array  $data
     * @return array
     */
    private function parseForecastResponse(object|array $data): array
    {
        $forecast = [];
        foreach ($data->list as $weather) {
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
                'wind_speed' => $weather->wind->speed ?? '',
                'wind_degree' => $weather->wind->deg ?? '',
                'cloudiness_percent' => $weather->clouds->all,
                'rain_for_3_hour' => $weather->rain->{'3h'} ?? '',
                'snow_for_3_hour' => $weather->snow->{'3h'} ?? '',
                'time_of_data_calculation' => $weather->dt_txt,
                'date' => Carbon::now(),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ];
        }
        return $forecast;
    }
}
