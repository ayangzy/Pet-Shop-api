<?php

namespace Tests\Unit\Product;

use Tests\TestCase;
use App\Models\File;
use App\Models\Brand;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UpdateProductTest extends TestCase
{

    use WithFaker;
    /**
     * Test That can update a product.
     *
     * @return void
     */
    public function test_update_product()
    {
        $product = Product::factory()->create();
        $payload = $this->updateProductPayload();

        $response = $this->actingAsAdmin()
        ->putJson('/api/v1/product/'.$product->uuid, $payload);

        $response->assertStatus(200);
    }

    public function test_user_cannot_update_product_without_permission()
    {
        $product = Product::factory()->create();
        $payload = $this->updateProductPayload();

        $response = $this->putJson('/api/v1/product/'.$product->uuid, $payload);
        $response->assertStatus(400);
    }


    private function updateProductPayload()
    {
        $payload  = [
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

        return $payload;
    }
}
