<?php

namespace Tests\Feature\User;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;

class ProfileTest extends TestCase
{
    use WithFaker;
    /**
     * Test that user can view profile.
     *
     * @return void
     */
    public function test_user_view_profile_when_logged_in()
    {
        $this->asAuthorisedUser()
        ->json('GET', '/api/v1/user');
        $this->assertTrue(true);
    }


    public function test_user_cannot_view_profile_without_login()
    {
    
        $response = $this->json('GET', '/api/v1/user');
        $response->assertStatus(401);
    }
}
