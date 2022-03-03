<?php

namespace Tests\Unit\User;

use Tests\TestCase;
use App\Models\User;
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
    
    public function test_user_can_logout(): void
    {
        $response = $this->asAuthorisedUser()
        ->json('GET', 'api/v1/user/logout');
        $response->assertStatus(200);

    }
}
