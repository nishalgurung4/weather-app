<?php

namespace Tests\Feature\database;

use App\Models\City;
use App\Models\Weather;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Schema;
use Tests\TestCase;

class WeatherTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test the table columns corresponding to the Weather model
     *
     * @return void
     */
    public function test_weather_table_has_expected_columns()
    {
        $this->assertTrue(
            Schema::hasColumns('weather', [
                'id',
                'city_id',
                'condition',
                'description',
                'unit',
                'temperature',
                'humidity_percent',
                'pressure',
                'min_temperature',
                'max_temperature',
                'visibility_in_meter',
                'wind_speed',
                'wind_degree',
                'cloudiness_percent',
                'rain_for_hour',
                'snow_for_hour',
                'time_of_data_calculation',
                'date',
                'created_at',
                'updated_at'
            ])
        );
    }

    /**
     * Check that the model is saved in the database
     * @return void
     */
    public function test_weather_is_saved_in_database()
    {
        $city = City::factory()->create();
        $weather = Weather::factory()->create(['city_id' => $city->id]);
        $this->assertDatabaseHas('weather', $weather->attributesToArray());
    }

    /**
     * Test the relationship between weather and the city model
     * to verify, there must a city assign to the weather
     */
    public function test_weather_belongs_to_a_city()
    {
        $city = City::factory()->create();
        $weather = Weather::factory()->create(['city_id' => $city->id]);

        // Method 1: the city of the weather is an instance of the City class
//        $this->assertInstanceOf(City::class, $weather->city);

        // Method 2: The city number of the weather is indeed equal to 1
        $this->assertEquals(1, $weather->city()->count());
    }

    /**
     * Checks that the foreign key constraint for the city is taken into account in the table linked to the Weather model
     */
    public function test_weather_table_throws_integrity_constraint_exception_on_non_existing_city_id()
    {
        $this->expectException("Illuminate\Database\QueryException");
        $this->expectExceptionCode(23000);
        Weather::factory()->create(['city_id' => 0]);
    }
}
