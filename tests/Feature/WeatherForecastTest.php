<?php

namespace Tests\Feature;

use App\Models\City;
use App\Models\Weather;
use Illuminate\Foundation\Testing\RefreshDatabase;
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

}
