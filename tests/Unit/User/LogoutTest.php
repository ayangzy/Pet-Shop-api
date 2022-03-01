<?php

namespace Tests\Unit\User;

use Tests\TestCase;
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
        $response = $this->asAuthorisedUser()
        ->json('POST', '/api/v1/user/logout');
        $response->assertStatus(200);

    }
}
