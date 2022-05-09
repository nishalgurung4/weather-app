<?php

namespace Database\Factories;

use App\Models\City;
use App\Models\Weather;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory
 */
class WeatherFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Weather::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'city_id' => City::factory()->make(),
            'condition' => $this->faker->randomElement(['Rain', 'Snow', 'Extreme']),
            'description' => $this->faker->text,
            'unit' => $this->faker->randomElement(['0', '1', '2']),
            'temperature' => $this->faker->randomDigit(),
            'humidity_percent' => $this->faker->numberBetween(0, 100),
            'pressure' => $this->faker->randomDigit(),
            'min_temperature' => $this->faker->randomDigit(),
            'max_temperature' => $this->faker->randomDigit(),
            'visibility_in_meter' => $this->faker->numberBetween(1, 10000),
            'wind_speed' => $this->faker->randomDigit(),
            'wind_degree' => $this->faker->numberBetween(0, 360),
            'cloudiness_percent' => $this->faker->numberBetween(0, 100),
            'rain_for_3_hour' => $this->faker->randomDigit(),
            'snow_for_3_hour' => $this->faker->randomDigit(),
            'time_of_data_calculation' => $this->faker->dateTime,
            'date' => $this->faker->date
        ];
    }
}
