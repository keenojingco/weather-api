<?php

namespace App\Providers;

use App\Services\OpenWeatherMap\OpenWeatherMapService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $this->app->singleton(
            abstract: OpenWeatherMapService::class,
            concrete: fn() => new OpenWeatherMapService(
                baseUrl: config('services.open-weather-map.url'),
            )
        );
    }
}
