<?php

namespace Tests\Feature\User;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class LogoutTest extends TestCase
{
    use WithFaker;
    
    /**
     * Tests that users can log out
     *
     * @return void
     */
    
    public function test_user_can_logout_when_loggedIn(): void
    {
        $response = $this->asAuthorisedUser()
        ->json('GET', 'api/v1/user/logout');
        $response->assertStatus(200);

    }

    public function test_user_cannot_logout_without_login(): void
    {
        $response = $this->json('GET', 'api/v1/user/logout');
        $response->assertStatus(401);

    }
}
