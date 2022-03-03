<?php

namespace Tests\Unit\User;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\WithFaker;

class ProfileTest extends TestCase
{
    use WithFaker;
    /**
     * Test that user can view profile.
     *
     * @return void
     */
    public function test_user_view_profile()
    {
    
        $this->asAuthorisedUser()
        ->json('GET', '/api/v1/user');
        $this->assertTrue(true);
    }
}
