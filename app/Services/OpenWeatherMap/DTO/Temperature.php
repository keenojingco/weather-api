<?php

namespace App\Services\OpenWeatherMap\DTO;

class Temperature
{
    public function __construct(
        public readonly float $value,
        public readonly float $feelsLike,
        public readonly float $minimumTemperature,
        public readonly float $maximumTemperature,
    ) {}
}
