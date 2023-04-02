<?php

namespace Tests\Feature\City;

use App\Models\City;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Str;
use Tests\TestCase;

class StoreControllerTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    const ROUTE = '/api/cities';

    private array $expectedJsonResponse = [
        'data' => [
            'id',
            'name',
            'created_at',
            'updated_at',
        ]
    ];

    /** @test */
    public function it_can_store_a_city(): void
    {
        $city = $this->faker->city;

        $this->postJson(self::ROUTE, [
            'city' => $city,
        ])
            ->assertOk()
            ->assertJsonStructure($this->expectedJsonResponse);

        $this->assertDatabaseHas('cities', [
            'name' => $city
        ]);
    }

    /** @test */
    public function it_can_validate_the_city_name(): void
    {
        $this->postJson(self::ROUTE)
            ->assertUnprocessable()
            ->assertJsonPath(
                'message',
                'The city field is required.'
            );


        $this->postJson(self::ROUTE, ['city' => 100])
            ->assertUnprocessable()
            ->assertJsonPath(
                'message',
                'The city field must be a string.'
            );

        $this->postJson(self::ROUTE, ['city' => Str::random(101)])
            ->assertUnprocessable()
            ->assertJsonPath(
                'message',
                'The city field must not be greater than 100 characters.'
            );
    }

    /** test */
    public function it_can_validate_the_city_name_uniqueness()
    {
        $city = City::factory()->create();

        $this->postJson(self::ROUTE, ['city' => $city->name])
            ->assertUnprocessable()
            ->assertJsonPath(
                'message',
                'The city has already been taken.'
            );
    }
}
