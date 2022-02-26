<?php

namespace Database\Factories;

use App\Models\File;
use App\Models\Brand;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
       /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Product::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'uuid' => Str::uuid(),
            'category_uuid' => Category::all()->random()->uuid,
            'title' => $this->faker->sentence(2),
            'price' => $this->faker->randomFloat(10, 0, 20000),
            'description' => $this->faker->paragraph(3),
            'metadata' => json_encode([
                "brand" => Brand::all()->random()->uuid,
                "image" => File::factory()->create()->uuid
            ])
        ];
    }
}
