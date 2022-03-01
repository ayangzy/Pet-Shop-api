<?php

namespace Tests\Unit\Auth;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class DeleteUserAccountTest extends TestCase
{
    use WithFaker;
    use RefreshDatabase;
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
