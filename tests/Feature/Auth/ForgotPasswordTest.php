<?php

namespace Tests\Feature\Auth;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use App\Mail\ForgotPasswordMailable;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Support\Facades\Mail;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Testing\Fluent\AssertableJson;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ForgotPasswordTest extends TestCase
{
    use WithFaker;
    use DatabaseMigrations;

    public function test_it_will_send_an_email_to_user_with_reset_password_token()
    {
        Mail::fake();
        $user = User::factory()->create();

        $response = $this->post('api/v1/user/forgot-password',
            [
                'email' => $user->email
            ]
        );

        $this->assertNotNull($token = DB::table('password_resets')->first());
        Mail::to($user->email)->send(new ForgotPasswordMailable($user, $token));
        $response->assertOk();
    }


    public function test_it_does_not_send_email_if_not_registered()
    {
        Mail::fake();
        $user = User::factory()->create();

        $response = $this->post('api/v1/user/forgot-password',
            [
                'email' => $user->email
            ]
        );
        Mail::assertNotSent($user, ForgotPasswordMailable::class);
        $response->assertOk();
    }

    public function it_requires_email_for_password_rest()
    {
        $this->post('api/v1/user/forgot-password', [] )
        ->assertStatus(422)
        ->assertJson(function (AssertableJson $json) {
            $json->has('errors')
                ->has('errors.email')
                ->etc();
        });

    }
}
