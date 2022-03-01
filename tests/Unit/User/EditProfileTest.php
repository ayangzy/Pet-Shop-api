<?php

namespace Tests\Unit\User;

use Tests\TestCase;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Testing\WithFaker;

class EditProfileTest extends TestCase
{
    use WithFaker;
    /**
     * test to update a user profile.
     *
     * @return void
     */
    public function test_that_can_update_user_profile()
    {
        $userData = $this->userPayload();
        $userData['password_confirmation'] = 'password';
        $response = $this->asAuthorisedUser()
        ->json('PUT', '/api/v1/user/edit', $userData);
        $response->assertStatus(200);
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
