<?php

namespace App\Services\OpenWeatherMap\Resources;

use App\Services\OpenWeatherMap\OpenWeatherMapService;

use Illuminate\Http\Client\Response;

class ForecastResource
{
    public function __construct(
        private readonly OpenWeatherMapService $service,
    ) {}

    public function list(string $city): Response
    {
        return $this->service->get(
            request: $this->service->buildRequest(),
            url: 'data/2.5/forecast',
            query: [
                'q' => "$city",
                'appid' => config('services.open-weather-map.key'),
            ]
        );
    }
}
