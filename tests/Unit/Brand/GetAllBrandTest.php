<?php

namespace Tests\Unit\Brand;

use App\Models\Brand;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class GetAllBrandTest extends TestCase
{
    /**
     * This test list all categories
     *
     * @return void
     */
    public function test_that_cateories_can_be_viewed()
    {
        $brands = Brand::factory()->create()->toArray();

        $response = $this->getJson('api/v1/brands', $brands);
        
        $response->assertStatus(200);
    }
}
