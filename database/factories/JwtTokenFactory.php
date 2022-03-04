<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\JwtToken;
use Illuminate\Database\Eloquent\Factories\Factory;

class JwtTokenFactory extends Factory
{
     /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = JwtToken::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => User::factory()->create()->id,
            'unique_id' => $this->faker->unique()->numberBetween(1, 100),
            'token_title' => $this->faker->sentence(),
        ];
    }
}
