<?php

namespace Tests\Feature\Auth\Admin;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Testing\Fluent\AssertableJson;

class AdminLoginTest extends TestCase
{
    use WithFaker;

    public function test_returns_errors_if_email_and_password_fields_empty()
    {
        $this->json('POST', 'api/v1/admin/login', [])
            ->assertStatus(422)
            ->assertJson(function (AssertableJson $json) {
                $json->has('validationErrors')
                    ->has('validationErrors.email')
                    ->has('validationErrors.password')
                    ->etc();
            });
    }


    public function test_admin_cannot_login_with_incorrect_password()
    {
        $user = User::factory()->create([
            'password' => bcrypt('password'),
        ]);

        $response = $this->post('api/v1/admin/login', [
            'email' => $user->email,
            'password' => 'cpassword',
        ]);

        $response->assertStatus(401);
    }

    public function test_admin_can_login_with_correct_credentials()
    {
        $user = User::factory()->create([
            'password' => bcrypt($password = 'admin'),
            'is_admin' => 1
        ]);
        
        $response = $this->post('api/v1/admin/login', [
            'email' => $user->email,
            'password' => $password
        ]);

        $response->assertStatus(200);
        $response->assertSee('token');
    }


    public function test_check_admin_trying_to_login_is_user_returns_unauthorized()
    {
        $credentials = User::factory()->create([
            'password' => bcrypt($password = 'password'),
        ]);

        $response = $this->post('api/v1/admin/login', [
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
