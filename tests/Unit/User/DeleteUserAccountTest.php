<?php

namespace Tests\Unit\User;

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

    public function test_user_can_delete_account()
    {
        $response = $this->asAuthorisedUser()
        ->json('DELETE', '/api/v1/user');
        $response->assertStatus(200);
    }

}
