<?php

namespace App\Jobs;

use App\Models\City;
use App\Models\Weather;
use App\Services\ExternalWeatherService;
use Exception;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
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
            Weather::insert($weather->getWeathers($this->city->name)->format());
        } catch (Exception $e) {
            Log::error("Insertion Error of ".$this->city->name . " due to ". $e->getMessage());
        }
    }
}
