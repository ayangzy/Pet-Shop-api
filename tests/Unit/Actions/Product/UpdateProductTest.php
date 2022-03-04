<?php

namespace Tests\Unit\Actions\Product;

use Tests\TestCase;
use App\Models\File;
use App\Models\Brand;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Str;
use App\Http\Requests\UpdateProductRequest;
use Illuminate\Foundation\Testing\WithFaker;
use App\Http\Actions\Product\UpdateProductAction;

class UpdateProductTest extends TestCase
{
    use WithFaker;

    private $newInstanceOfClass;

    /**
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();
        $this->productUuid =  Product::factory()->create();
        $this->newInstanceOfClass = new UpdateProductAction($this->request(),  $this->productUuid);
    }

    /**
     * Execute method test for product update should return true
     *
     * @return void
     */
    public function test_execute_method_for_product_update_should_return_true()
    {
        $this->assertTrue($this->newInstanceOfClass->execute($this->request(), $this->productUuid ));
    }

    /**
     * @return UpdateProductRequest
     */
    private function request(): UpdateProductRequest
    {
        $request = new UpdateProductRequest();

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
