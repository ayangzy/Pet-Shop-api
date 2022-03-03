<?php

namespace Tests\Unit\Actions\Product;

use Tests\TestCase;
use App\Models\File;
use App\Models\Brand;
use App\Models\Category;
use Illuminate\Support\Str;
use App\Http\Requests\CreateProductRequest;
use Illuminate\Foundation\Testing\WithFaker;
use App\Http\Actions\Product\CreateProductAction;

class CreateProductTest extends TestCase
{
    use WithFaker;

    private $newInstanceOfClass;

    /**
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();
        $this->newInstanceOfClass = new CreateProductAction($this->request());
    }

    /**
     * Execute method test for product creation
     *
     * @return void
     */
    public function test_execute_method_for_product_create_should_return_true()
    {
        $this->assertIsObject($this->newInstanceOfClass->execute($this->request()));
    }

    /**
     * @return CreateProductRequest
     */
    private function request(): CreateProductRequest
    {
        $request = new CreateProductRequest();

        $request->merge([
            'category_uuid' => Category::factory()->create()->uuid,
            'uuid' => Str::orderedUuid(),
            'title' => $this->faker->sentence(2),
            'price' => $this->faker->randomFloat(2, 0, 10000),
            'description' => $this->faker->paragraph(3),
            'metadata' => json_encode([
                "brand" => Brand::factory()->create()->uuid,
                "image" => File::factory()->create()->uuid
            ]),
        ]);

        return $request;
    }
}
