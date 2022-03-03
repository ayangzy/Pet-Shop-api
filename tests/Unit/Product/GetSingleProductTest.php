<?php

namespace Tests\Unit\Product;

use Tests\TestCase;
use App\Models\Product;
use Illuminate\Support\Str;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class GetSingleProductTest extends TestCase
{/**
     * Test for getting single products.
     *
     * @return void
     */
    public function test_view_single_products()
    {
        $product = Product::factory()->create();
        $response = $this->getJson('api/v1/product/'.$product->uuid);
        $result = $response->assertStatus(200)->json('data');
        $this->assertEquals(data_get($result, 'uuid'), $product->uuid, 'Product not found');
    }
}
