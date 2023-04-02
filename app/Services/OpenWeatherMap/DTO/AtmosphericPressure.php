<?php

namespace App\Services\OpenWeatherMap\DTO;

class AtmosphericPressure
{
    public function __construct(
        public readonly float $value,
        public readonly float $seaLevel,
        public readonly float $groundLevel,
    ) {}
}
