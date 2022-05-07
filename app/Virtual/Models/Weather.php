<?php

namespace App\Virtual\Models;
use phpDocumentor\Reflection\Types\Integer;

/**
 * @OA\Schema(
 *     title="Weather",
 *     description="Weather model",
 *     @OA\Xml(
 *         name="Weather"
 *     )
 * )
 */
class Weather
{
    /**
     * @OA\Property(
     *     title="ID",
     *     description="ID",
     *     format="int64",
     *     example=1
     * )
     *
     * @var integer
     */
    private integer $id;

    /**
     * @OA\Property(
     *      title="City",
     *      description="City associate with the weather",
     * )
     *
     * @var City
     */
    private City $city;

    /**
     * @OA\Property(
     *     title="Condition",
     *     description="Group of weather parameters (Rain, Snow, Extreme etc.)",
     *     example="Rain"
     * )
     *
     * @var string
     */
    private string $condition;

    /**
     * @OA\Property(
     *     title="Description",
     *     description="Weather condition within the group",
     *     example="moderate rain"
     * )
     *
     * @var string
     */
    private string $description;

    /**
     * @OA\Property(
     *     title="Temperature",
     *     description="Temperature. Unit Default: Kelvin, Metric: Celsius, Imperial: Fahrenheit.",
     *     example=9.85
     * )
     *
     * @var float
     */
    private float $temperature;

    /**
     * @OA\Property(
     *     title="Humidity",
     *     description="Humidity, %",
     *     example=93
     * )
     *
     * @var float
     */
    private float $humidity_percent;

    /**
     * @OA\Property(
     *     title="Pressure",
     *     description="Atmospheric pressure, unit: Pascal",
     *     example=1010
     * )
     *
     * @var float
     */
    private float $pressure;

    /**
     * @OA\Property(
     *     title="Minimum Temperature",
     *     description="Minimum temperature at the moment. This is minimal currently observed temperature. Unit Default: Kelvin, Metric: Celsius, Imperial: Fahrenheit.",
     *     example=8.59
     * )
     *
     * @var float
     */
    private float $min_temperature;

    /**
     * @OA\Property(
     *     title="Maximum Temperature",
     *     description="Maximum temperature at the moment. This is minimal currently observed temperature. Unit Default: Kelvin, Metric: Celsius, Imperial: Fahrenheit.",
     *     example=8.59
     * )
     *
     * @var float
     */
    private float $max_temperature;

    /**
     * @OA\Property(
     *     title="Visibility Distance",
     *     description="Visibility, meter. The maximum value of the visibility is 10km",
     *     example=8.59
     * )
     *
     * @var integer
     */
    private integer $visibility_in_meter;

    /**
     * @OA\Property(
     *     title="Wind Speed",
     *     description="Wind speed. Unit Default: meter/sec, Metric: meter/sec, Imperial: miles/hour.",
     *     example=5.36
     * )
     *
     * @var float
     */
    private float $wind_speed;

    /**
     * @OA\Property(
     *     title="Wind Degree",
     *     description="Wind direction, degrees",
     *     example=81
     * )
     *
     * @var integer
     */
    private integer $wind_degree;

    /**
     * @OA\Property(
     *     title="Cloudiness Percent",
     *     description="Cloudiness, %",
     *     example=81
     * )
     *
     * @var integer
     */
    private integer $cloudiness_percent;

    /**
     * @OA\Property(
     *     title="Rain volume",
     *     description="Rain volume for the last 1 hour, mm",
     *     example=2.27
     * )
     *
     * @var integer
     */
    private integer $rain_for_hour;

    /**
     * @OA\Property(
     *     title="Snow volume",
     *     description="Snow volume for the last 1 hour, mm",
     *     example=5.17
     * )
     *
     * @var float
     */
    private float $snow_for_hour;

    /**
     * @OA\Property(
     *     title="Time of data calculation",
     *     description="Time of data calculation, unix, UTC",
     *     example="2022-05-07 07:05:41"
     * )
     *
     * @var string
     */
    private string $time_of_data_calculation;

    /**
     * @OA\Property(
     *     title="Date",
     *     description="Date of weather data",
     *     example="2022-05-07 07:05:41"
     * )
     *
     * @var string
     */
    private string $date;
}
