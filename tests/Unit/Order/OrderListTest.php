<?php

namespace Tests\Unit\Order;

use Tests\TestCase;
use App\Models\Order;
use Illuminate\Foundation\Testing\WithFaker;

class OrderListTest extends TestCase
{
    use WithFaker;
    /**
     * Test user can view order list.
     *
     * @return void
     */
    public function test_user_can_view_order_list_when_loggedIn()
    {
        $orders = Order::factory()->create();
        $response = $this->asAuthorisedUser()
        ->json('GET', '/api/v1/user/orders', [$orders]);
        $response->assertStatus(200);
    }

    public function test_user_cannot_view_order_list_without_logIn()
    {
        $response = $this->json('GET', '/api/v1/user/orders');
        $response->assertStatus(401);
    }
}
