<?php

namespace App\Services\OpenWeatherMap\DTO;

use Carbon\Carbon;

class Forecast
{
    public function __construct(
        public readonly Carbon $timestamp,
        public readonly Main $main
    ) {}

    public function toArray(): array
    {
        return [
            'timestamp' => $this->timestamp,
            'main' => $this->main,
        ];
    }
}
