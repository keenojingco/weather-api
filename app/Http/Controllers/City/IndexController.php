<?php

namespace App\Http\Controllers\City;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Services\OpenWeatherMap\Resources\ForecastResource;
use Illuminate\Http\JsonResponse;

class IndexController extends Controller
{
    public function __construct(
        private readonly ForecastResource $api,
    ) {}

    public function __invoke(): JsonResponse
    {
        $cities = City::all()->map(function($city) {
            $forecasts = $this->api->list($city->name)->object();

            return [
                'city' => $city,
                'forecast' => $forecasts->list,
            ];
        });

        return response()->json([
            'data' => $cities,
        ]);
    }
}
