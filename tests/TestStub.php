<?php


namespace Tests;


use App\Models\User;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Foundation\Testing\Concerns\MakesHttpRequests;

trait TestStub
{

    public function setUp(): void
    {
        parent::setUp();
        $this->user =  User::factory()->create(['is_admin' => 0]);
        $this->admin =  User::factory()->create(['is_admin' => 1]);
    }
    
    /**
     * @return MakesHttpRequests
     */
    public function asAuthorisedUser($driver = null)
    {
        $token = JWTAuth::fromUser($this->user);
        $this->withHeader('Authorization', "Bearer {$token}");
        parent::actingAs($this->user);

        return $this;
    }

    public function actingAsAdmin($driver = null)
    {
        $token = JWTAuth::fromUser($this->admin);
        $this->withHeader('Authorization', "Bearer {$token}");
        parent::actingAs($this->admin);

        return $this;
    }
}
