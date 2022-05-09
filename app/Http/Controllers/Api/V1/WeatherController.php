<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Requests\Api\V1\WeatherRequest;
use App\Http\Resources\CityResource;
use App\Models\City;
use App\Models\Weather;
use App\Services\ExternalWeatherService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class WeatherController extends BaseController
{

    /**
     * Fetch forecast data of given date from the database
     * @param  WeatherRequest  $request
     * @param  ExternalWeatherService  $weatherService
     * @return JsonResponse| AnonymousResourceCollection
     * @OA\Get (
     *      path="/forecast",
     *      operationId="indexWeather",
     *      tags={"forecast"},
     *      summary="Fetch 5 days forecast with 3-hour step.",
     *      description="Returns object",
     *      @OA\Parameter(
     *          name="date",
     *          description="Weather forecast date",
     *          in="query",
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\JsonContent(ref="#/components/schemas/Weather")
     *       ),
     *      @OA\Response(
     *          response=422,
     *          description="Validation error",
     *          @OA\JsonContent(
     *              @OA\Property (property="message", type="string",
     *                  example="The given data was invalid."
     *              ),
     *              @OA\Property (property="errors", type="object",
     *                  @OA\Property (property="date", type="array",
     *                      @OA\Items (type="string", example="The date field is required")
     *                  ),
     *              ),
     *          )
     *      )
     *  )
     */

    public function index(WeatherRequest $request, ExternalWeatherService $weatherService)
    {
        $dataCount = Weather::where('date', $request->date)->count();
        if (!$dataCount) {
            return $this->sendError("No data available");
        }
        $cities = City::with([
            'weathers' => function ($query) use ($request) {
                $query->whereDate('date', $request->date);
            }
        ])->get();
        return CityResource::collection($cities);
    }
}
