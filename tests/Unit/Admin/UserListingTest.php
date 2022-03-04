<?php

namespace Tests\Unit\Admin;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserListingTest extends TestCase
{

    /**
     * This test enable admin to view all users
     *
     * @return void
     */
    
    public function test_admin_can_view_all_users()
    {
        $users = User::factory()->create();
        $response = $this->actingAsAdmin()
        ->json('GET', 'api/v1/admin/user-listing', [$users]);
        $response->assertStatus(200);

    }
}
