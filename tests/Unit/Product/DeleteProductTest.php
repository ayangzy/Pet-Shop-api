<?php

namespace Tests\Unit\Product;

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
}
