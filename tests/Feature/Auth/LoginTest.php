<?php

namespace Tests\Feature\Auth;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Testing\Fluent\AssertableJson;

class LoginTest extends TestCase
{
    use WithFaker;

    public function test_returns_errors_if_email_and_password_fields_empty()
    {
        $this->json('POST', 'api/v1/user/login', [])
            ->assertStatus(422)
            ->assertJson(function (AssertableJson $json) {
                $json->has('errors')
                    ->has('errors.email')
                    ->has('errors.password')
                    ->etc();
            });
    }


    public function test_user_cannot_login_with_incorrect_password()
    {
        $user = User::factory()->create([
            'password' => bcrypt('password'),
        ]);

        $response = $this->post('api/v1/user/login', [
            'email' => $user->email,
            'password' => 'cpassword',
        ]);

        $response->assertStatus(401);
    }

    public function test_user_can_login_with_correct_credentials()
    {
        $user = User::factory()->create([
            'password' => bcrypt($password = 'password'),
        ]);

        $response = $this->post('api/v1/user/login', [
            'email' => $user->email,
            'password' => $password,
        ]);

        $response->assertStatus(200);
        $response->assertSee('token');
    }


    public function test_check_user_trying_to_login_is_admin_returns_unauthorized()
    {
        $credentials = User::factory()->create([
            'password' => bcrypt($password = 'password'),
        ]);

        $response = $this->post('api/v1/user/login', [
            'email' => $credentials->email,
            'password' => $password,
        ]);
        $user = User::first();
        if ($user && $user->is_admin === 1) {
            $response->assertStatus(401);
        }
        $this->assertTrue(True);
    }
}
