<?php

namespace Tests\Unit\Admin;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AdminLogoutTest extends TestCase
{

    /**
     * Tests that admin can log out
     *
     * @return void
     */
    
    public function test_user_can_logout()
    {
        $response = $this->actingAsAdmin()
        ->json('GET', 'api/v1/admin/logout');
        $response->assertStatus(200);

    }
}
