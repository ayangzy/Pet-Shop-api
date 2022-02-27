<?php

namespace Tests\Feature\Auth;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Testing\Fluent\AssertableJson;

class RegistrationTest extends TestCase
{
    use WithFaker;

    public function test_allow_a_user_to_register_successfully()
    {
        $userData = $this->userRegistrationData();
        $userData['password_confirmation'] = 'password';
        $response = $this->json('POST', 'api/v1/user/create', $userData);
        $response->assertStatus(201);
    }

    public function test_it_validates_required_fields()
    {

        $this->json('POST', 'api/v1/user/create', [])
            ->assertStatus(422)
            ->assertJson(function (AssertableJson $json) {
                $json->has('errors')
                    ->has('errors.email')
                    ->has('errors.first_name')
                    ->has('errors.last_name')
                    ->has('errors.phone_number')
                    ->has('errors.address')
                    ->has('errors.password')
                    ->etc();
            });
    }


    public function test_validates_password_are_same()
    {
        $userData = $this->userRegistrationData();
        $userData['password_confirmation'] = 'cpassword';
        $this->json('POST', 'api/v1/user/create', $userData)
            ->assertStatus(422)
            ->assertJson(function (AssertableJson $json) {
                $json->has('errors')
                    ->has('errors.password')->etc();
            });
    }


    private function userRegistrationData()
    {
        return [
            'first_name' => $this->faker->firstName(),
            'last_name' => $this->faker->lastName(),
            'is_admin' => 0,
            'email' => $this->faker->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => 'password',
            'address' => $this->faker->address(),
            'phone_number' => '+' . $this->faker->randomDigitNotZero() . $this->faker->numerify('###-###-####'),
        ];
    }
}
