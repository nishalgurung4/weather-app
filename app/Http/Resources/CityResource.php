<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use JetBrains\PhpStorm\ArrayShape;

class CityResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  Request  $request
     * @return array
     */
    #[ArrayShape([
        'name' => "mixed",
        'latitude' => "mixed",
        'longitude' => "mixed",
        'forecast' => "\App\Http\Resources\WeatherResource"
    ])] public function toArray($request): array
    {
        return [
            'name' => $this->name,
            'latitude' => $this->latitude,
            'longitude' => $this->longitude,
            'forecast' => WeatherResource::collection($this->whenLoaded('weathers'))
        ];
    }
}
