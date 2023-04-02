<?php

namespace App\Services\OpenWeatherMap;

use App\Services\Concerns\BuildBaseRequest;
use App\Services\Concerns\CanSendGetRequest;
use App\Services\OpenWeatherMap\Resources\ForecastResource;

class OpenWeatherMapService
{
    use BuildBaseRequest;
    use CanSendGetRequest;

    public function __construct(
        private readonly string $baseUrl,
    ) {}
}
