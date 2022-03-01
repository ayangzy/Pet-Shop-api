<?php

namespace Tests\Feature\Auth;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Password;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ResetPasswordTest extends TestCase
{
    use WithFaker;

    /**
     * Class ResetPasswordTest
     * @group auth
     */


    /**
     * @param $user
     * @return mixed
     */
    private function getValidToken($user)
    {
        return Password::createToken($user);
    }


    public function test_it_reset_password_with_valid_token()
    {

        $user = User::factory()->create();

        $this->post('api/v1/user/reset-password-token', [
            'token' => $this->getValidToken($user),
            'email' => $user->email,
            'password' => 'new-password',
            'password_confirmation' => 'new-password',
        ]);
        $this->assertTrue(Hash::check('password', $user->fresh()->password));
    }



    public function test_it_doesnt_reset_password_with_invalid_token()
    {
        $user = User::factory()->create([
            'password' => bcrypt('password')
        ]);
        $token = $this->getValidToken($user);

        $this->from(route('user.resetPassword', $token))->post('api/v1/user/reset-password-token', [
            'token' => strtoupper(Str::random(6)),
            'email' => $user->email,
            'password' => 'new-password',
            'password_confirmation' => 'new-password',
        ]);

        $this->assertEquals($user->email, $user->fresh()->email);
        $this->assertTrue(Hash::check('password', $user->fresh()->password));
        $this->assertGuest();
    }


    public function test_it_doesnt_update_with_empty_password()
    {

        $user = User::factory()->create([
            'password' => bcrypt('password')
        ]);
        $token = $this->getValidToken($user);

        $response = $this->from(route('user.resetPassword', $token))->post('api/v1/user/reset-password-token', [
            'token' => strtoupper(Str::random(6)),
            'email' => $user->email,
            'password' => '',
            'password_confirmation' => '',
        ]);

        $response->assertSessionHasErrors('password');
        $this->assertTrue(Hash::check('password', $user->fresh()->password));
        $this->assertGuest();
    }


    public function test_it_doesnt_update_password_with_blank_email()
    {
        $user = User::factory()->create([
            'password' => bcrypt('password')
        ]);
        $token = $this->getValidToken($user);

        $response = $this->from(route('user.resetPassword', $token))->post('api/v1/user/reset-password-token', [
            'token' => strtoupper(Str::random(6)),
            'email' => '',
            'password' => 'new-password',
            'password_confirmation' => 'new-password',
        ]);
        $response->assertSessionHasErrors('email');
        $this->assertTrue(Hash::check('password', $user->fresh()->password));
        $this->assertGuest();
    }
}
