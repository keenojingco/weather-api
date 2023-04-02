<?php

namespace Tests\Feature\City;

use App\Models\City;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class IndexControllerTest extends TestCase
{
    use RefreshDatabase;

    const ROUTE = 'api/cities';

    private array $expectedJsonResponse = [
        'data' => [
            '*' => [
                'id',
                'name',
                'created_at',
                'updated_at',
            ],
        ],
    ];

    /** @test */
    public function it_can_retrieve_cities(): void
    {
        City::factory()->create();

        $this->getJson(self::ROUTE)
            ->assertOk()
            ->assertJsonStructure($this->expectedJsonResponse);
    }
}
