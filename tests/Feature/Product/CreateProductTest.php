<?php

namespace Tests\Feature\Product;

use Tests\TestCase;
use App\Models\File;
use App\Models\User;
use App\Models\Brand;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Testing\Fluent\AssertableJson;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CreateProductTest extends TestCase
{

    use WithFaker;
    /**
     * testing for product creation.
     *
     * @return void
     */

    public function test_validate_product_payload()
    {
        $this->actingAsAdmin()->json('POST', 'api/v1/product/create', [])
            ->assertStatus(422)
            ->assertJson(function (AssertableJson $json) {
                $json->has('errors')
                    ->has('errors.title')
                    ->has('errors.price')
                    ->has('errors.description')
                    ->has('errors.metadata')
                    ->has('errors.category_uuid')
                    ->etc();
            });
    }

    public function test_admin_can_create_a_new_product_successfully()
    {
        $payload = [
            'title' => $this->faker()->sentence(),
            'title' => $this->faker->unique()->sentence(),
            'price' => $this->faker->randomFloat(10, 0, 20000),
            'description' => $this->faker->paragraph(3),
            'category_uuid' => Category::factory()->create()->uuid,
            'metadata' => json_encode([
                "brand" => Brand::factory()->create()->uuid,
                "image" => File::factory()->create()->uuid
            ])
        ];
        $response = $this->actingAsAdmin()
        ->json('POST', '/api/v1/product/create', $payload);
        $response->assertStatus(201);
    }
}
