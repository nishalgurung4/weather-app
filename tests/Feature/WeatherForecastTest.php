<?php

namespace Tests\Feature;

use App\Events\NoWeatherFound;
use App\Jobs\FetchWeather;
use App\Listeners\FetchWeatherFromApi;
use App\Models\City;
use App\Models\Weather;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Bus;
use Illuminate\Support\Facades\Event;
use Tests\TestCase;

class WeatherForecastTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Date is a mandatory field
     *
     * @test
     */
    public function it_requires_date()
    {
        $this->json('GET', 'api/v1/forecast')
            ->assertStatus(422);
    }

    /**
     * The date must be in a valid date format.
     * @test
     */
    public function it_returns_a_validation_error_when_invalid_date_is_provided()
    {
        $this->getJson('api/v1/forecast?date=wrong_format')
            ->assertStatus(422);
    }

    /**
     * When no data is found, an error message must be displayed.
     * @test
     */
    public function it_returns_error_when_no_weather_data_available_in_db()
    {
        $cities = City::select('id', 'name')->get();
        foreach ($cities as $city) {
            Weather::factory(40)->create(['city_id' => $city->id, 'date' => '2020-5-9']);
        }
        $this->getJson('api/v1/forecast?date=2020-5-8')
            ->assertStatus(404)
            ->assertJson([
                'message' => "No data available"
            ]);
    }

    /**
     * Returns the weather forecast data for the cities in the database.
     * @test
     */
    public function it_returns_weather_data_when_available_in_db()
    {
        $cities = City::select('id', 'name')->get();
        foreach ($cities as $city) {
            Weather::factory(40)->create(['city_id' => $city->id, 'date' => '2020-5-9']);
        }
        $this->getJson('api/v1/forecast?date=2020-5-9')
            ->assertStatus(200);
    }

    /**
     * Must dispatch NoWeatherFound Event only when the date is today and no record is found
     * @test
     */
    public function it_should_dispatch_no_weather_found_event_when_no_record_found_and_the_date_is_today()
    {
        Event::fake();
        $cities = City::select('id', 'name')->get();
        foreach ($cities as $city) {
            Weather::factory(40)->create(['city_id' => $city->id, 'date' => '2022-5-8']);
        }
        $this->get('api/v1/forecast?date='. Carbon::now()->toDateString());
        Event::assertDispatched(NoWeatherFound::class);
        Event::assertListening(NoWeatherFound::class, FetchWeatherFromApi::class);
    }

    /**
     * @test
     */
    public function it_should_not_dispatch_event_when_the_date_is_not_today()
    {
        Bus::fake();
        Event::fake();
        $cities = City::select('id', 'name')->get();
        foreach ($cities as $city) {
            Weather::factory(40)->create(['city_id' => $city->id, 'date' => Carbon::now()->toDateString()]);
        }
        $this->get('api/v1/forecast?date='. '2022-5-8');
        Event::assertNotDispatched(NoWeatherFound::class);
        Bus::assertNotDispatched(FetchWeather::class);
    }

    /**
     *
     * @test
     */
    public function it_should_not_dispatch_event_when_there_is_record()
    {
        Bus::fake();
        Event::fake();
        $cities = City::select('id', 'name')->get();
        foreach ($cities as $city) {
            Weather::factory(40)->create(['city_id' => $city->id, 'date' => '2022-5-9']);
        }
        $this->get('api/v1/forecast?date=2022-5-9');
        Event::assertNotDispatched(NoWeatherFound::class);
        Bus::assertNotDispatched(FetchWeather::class);
    }
}
