<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class WeatherController extends Controller
{
    /**
     * @OA\Get(
     *     path="/",
     *     description="Home page",
     *     @OA\Response(response="default", description="Welcome page")
     * )
     */
    public function index()
    {

    }
}
