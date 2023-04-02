<?php

namespace App\Services\OpenWeatherMap\DTO;

class Main
{
    public function __construct(
        public readonly Temperature $temperature,
        public readonly AtmosphericPressure $atmosphericPressure,
        public readonly float $humidity,
    ) {}
}
