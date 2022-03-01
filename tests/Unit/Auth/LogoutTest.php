<?php

namespace Tests\Unit\Auth;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class LogoutTest extends TestCase
{
    use WithFaker;
    use RefreshDatabase;
    /**
     * Tests that users can log out
     *
     * @return void
     */
    
    public function test_user_can_logout(): void
    {
        
        $user = User::factory()->create([
            'email' => $this->faker->unique()->email,
            'password' => bcrypt('password'),
        ]);

        $userLogin = $this->postJson(route('user.login'), [
            'email' => $user->email,
            'password' => "password",
        ]);

        $authToken = json_decode($userLogin->getContent())->data->token;

        $header = [
            'Authorization' => 'Bearer ' . $authToken,
        ];

        $response = $this->withHeaders($header)
                    ->postJson(route('user.logout'));
        
        $response->assertStatus(200);

    }
}
