<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;

/**
 * @OA\Info(
 *     title="Weather App",
 *     version="1.0",
 *     @OA\Contact(
 *     name="Er. Nishal Gurung",
 *     email="nishal.gurung4@gmail.com",
 *     url="https://nishalgurung.name.np"
 * )
 * )
 * @OA\Server(
 *      url="https://weather.nishalgurung.name.np/api/v1/",
 *      description="Deployment Server"
 *),
 * @OA\Server(
 *      url="http://weather-app.test/api/v1/",
 *      description="Development Server"
 *)
 */
class BaseController extends Controller
{
    /**
     * return error response.
     *
     * @return JsonResponse
     */
    public function sendError($message, $errors = [], $code = 404)
    {
        $response = [
            'message' => $message,
            'errors' => $errors
        ];
        return response()->json($response, $code);
    }
}
