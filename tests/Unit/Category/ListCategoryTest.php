<?php

namespace Tests\Unit\Category;

use App\Models\Category;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ListCategoryTest extends TestCase
{
    /**
     * This test list all categories
     *
     * @return void
     */
    public function test_that_cateories_can_be_viewed()
    {
        $categories = Category::factory()->create()->toArray();

        $response = $this->getJson('api/v1/categories', $categories);
        
        $response->assertStatus(200);
    }
}
