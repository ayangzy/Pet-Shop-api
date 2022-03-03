<?php

namespace Tests\Unit\Order;

use Tests\TestCase;
use App\Models\Order;

class OrderListTest extends TestCase
{
    /**
     * Test user can view order list.
     *
     * @return void
     */
    public function test_user_can_view_order_list()
    {
        $orders = Order::factory()->create();
        $response = $this->asAuthorisedUser()
        ->json('GET', '/api/v1/user/orders', [$orders]);
        $response->assertStatus(200);
    }
}
