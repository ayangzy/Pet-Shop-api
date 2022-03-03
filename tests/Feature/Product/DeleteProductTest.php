<?php

namespace Tests\Feature\Product;

use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class DeleteProductTest extends TestCase
{
    /**
     * Test that delete a particular product.
     *
     * @return void
     */
    public function test_delete_product()
    {
        $product = Product::factory()->create();
        $response = $this->actingAsAdmin()
        ->deleteJson('api/v1/product/'.$product->uuid);
        $response->assertStatus(200);
    }

    public function test_returns_404_if_product_not_found_to_delete()
    {
        $response = $this->actingAsAdmin()
        ->deleteJson('api/v1/product');
        $response->assertStatus(404);
    }
}
