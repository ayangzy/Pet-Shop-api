<?php

namespace Tests\Feature\User;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;

class EditProfileTest extends TestCase
{
    use WithFaker;
    /**
     * test to update a user profile.
     *
     * @return void
     */
    public function test_that_only_authenticated_user_can_update_profile()
    {
        $userData = $this->userPayload();
        $userData['password_confirmation'] = 'password';
        $response = $this->asAuthorisedUser()
        ->json('PUT', '/api/v1/user/edit', $userData);
        $response->assertStatus(200);
    }


    public function test_that_non_authenticated_user_cannot_update_profile()
    {
        $response = $this->json('PUT', '/api/v1/user/edit');
        $response->assertStatus(401);
    }


    private function userPayload()
    {
        return [
            'first_name' => $this->faker->firstName(),
            'last_name' => $this->faker->lastName(),
            'email' => $this->faker->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => 'password',
            'address' => $this->faker->address(),
            'phone_number' => '+' . $this->faker->randomDigitNotZero() . $this->faker->numerify('###-###-####'),
        ];
    }
}
