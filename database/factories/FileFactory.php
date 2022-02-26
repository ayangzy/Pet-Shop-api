<?php

namespace Database\Factories;

use App\Models\File;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class FileFactory extends Factory
{
     /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = File::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'uuid' => Str::uuid(),
            'name' => $this->faker->name,
            'path' => $this->faker->imageUrl(),
            'size' => $this->faker->randomNumber(1, 100),
            'type' => 'jpg',
        ];
    }
}
