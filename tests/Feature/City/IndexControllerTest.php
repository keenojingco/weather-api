<?php

namespace Tests\Feature\City;

use App\Models\City;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Http;
use Tests\TestCase;

class IndexControllerTest extends TestCase
{
    use RefreshDatabase;

    const ROUTE = 'api/cities';

    private array $expectedJsonResponse = [
        'data' => [
            '*' => [
                'city' => [
                    'id',
                    'name',
                    'created_at',
                    'updated_at',
                ],
                'forecast'
            ],
        ],
    ];

    /** @test */
    public function it_can_retrieve_cities_and_forecast(): void
    {
        Http::fake([
            'api.openweathermap.org/*' => Http::sequence()->push([
                'list' => [],
            ], 200),
        ]);

        City::factory()->create();

        $this->getJson(self::ROUTE)
            ->assertOk()
            ->assertJsonStructure($this->expectedJsonResponse);
    }
}
