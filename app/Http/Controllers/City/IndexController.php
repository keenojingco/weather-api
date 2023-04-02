<?php

namespace App\Http\Controllers\City;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Services\OpenWeatherMap\DTO\AtmosphericPressure;
use App\Services\OpenWeatherMap\DTO\Forecast;
use App\Services\OpenWeatherMap\DTO\Main;
use App\Services\OpenWeatherMap\DTO\Temperature;
use App\Services\OpenWeatherMap\Resources\ForecastResource;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Cache;

class IndexController extends Controller
{
    public function __construct(
        private readonly ForecastResource $api,
    ) {}

    public function __invoke(): JsonResponse
    {
        $cities = City::all();

        $cities->each(function ($city) {
            if (!Cache::has($city->id)) {
                $forecast = $this->api->list($city->name)->object();
                Cache::put($city->id, $forecast, now()->endOfDay());
            }
        });

        $cities = $cities->map(function($city) {
            $forecast = Cache::get($city->id);
            $forecastDto = collect($forecast->list)->map(function($list) {
                    return new Forecast(
                        timestamp: Carbon::parse($list->dt),
                        main: new Main(
                            temperature: new Temperature(
                                value: $list->main->temp,
                                feelsLike: $list->main->feels_like,
                                minimumTemperature: $list->main->temp_min,
                                maximumTemperature: $list->main->temp_max,
                            ),
                            atmosphericPressure: new AtmosphericPressure(
                                value: $list->main->pressure,
                                seaLevel: $list->main->sea_level,
                                groundLevel: $list->main->grnd_level,
                            ),
                            humidity: $list->main->humidity
                        )
                    );
                });

            return [
                'city' => $city,
                'forecast' => $forecastDto,
            ];
        });

        return response()->json([
            'data' => $cities,
        ]);
    }
}
