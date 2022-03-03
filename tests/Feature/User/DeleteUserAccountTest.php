<?php

namespace Tests\Feature\User;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class DeleteUserAccountTest extends TestCase
{
    use WithFaker;
    /**
     * Tests that users can delete account
     *
     * @return void
     */

    public function test_only_auth_user_can_delete_account()
    {
        $response = $this->asAuthorisedUser()
        ->json('DELETE', '/api/v1/user');
        $response->assertStatus(200);
    }

    public function test_non_auth_user_cannot_delete_account()
    {
        $response = $this->deleteJson('/api/v1/user');
        
        $response->assertStatus(401);
    }

}
