<?php

namespace App\Http\Resources;

use App\Models\Weather;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use JsonSerializable;

class WeatherResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  Request  $request
     * @return array|Arrayable|JsonSerializable
     */
    public function toArray($request): array|JsonSerializable|Arrayable
    {
        return [
            'condition' => $this->condition,
            'description' => $this->description,
            'unit' => $this->unit_description,
            'temperature' => $this->temperature,
            'humidity_percent' => $this->humidity_percent,
            'pressure' => $this->pressure,
            'min_temperature' => $this->min_temperature,
            'max_temperature' => $this->max_temperature,
            'visibility_in_meter' => $this->visibility_in_meter,
            'wind_speed' => $this->wind_speed,
            'wind_degree' => $this->wind_degree,
            'cloudiness_percent' => $this->cloudiness_percent,
            'rain_for_3_hour' => $this->rain_for_3_hour,
            'snow_for_3_hour' => $this->snow_for_3_hour,
            'time_of_data_calculation' => $this->time_of_data_calculation,
            'date' => $this->date
        ];
    }

}
