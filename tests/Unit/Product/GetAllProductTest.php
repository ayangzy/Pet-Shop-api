<?php

namespace Tests\Unit\Product;

use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class GetAllProductTest extends TestCase
{
    /**
     * Test for getting all products.
     *
     * @return void
     */
    public function test_view_all_products()
    {
        $products = Product::factory()->create()->toArray();

        $response = $this->getJson('api/v1/products', $products);
        
        $response->assertStatus(200);
    }
}
