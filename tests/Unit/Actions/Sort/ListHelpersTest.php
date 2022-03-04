<?php

namespace Tests\Unit\Actions\Sort;

use Tests\TestCase;
use App\Models\User;
use App\Models\Order;
use App\Http\Actions\ListActions;

class ListHelpersTest extends TestCase
{

    private $newInstanceOfClass;

    public function setUp(): void
    {
        parent::setUp();
    }

    /**
     * sortWithAuth method test
     *
     * @return void
     */
    public function test_sort_with_auth()
    {
        $user = new User([
            'id' => 1,
            'first_name' => 'Fake user'
        ]);

        $this->be($user);

        $this->newInstanceOfClass = new ListActions(Order::class, 'users');
        $this->assertIsObject($this->newInstanceOfClass->sortWithAuth());
    }
    /**
     * sortWithoutAuth method test
     *
     * @return void
     */

    public function test_sort_without_auth()
    {
        $this->newInstanceOfClass = new ListActions(Order::class, 'orders');
        $this->assertIsObject($this->newInstanceOfClass->sortWithoutAuth());
    }
    /**
     * sortWithUserFields method test
     *
     * @return void
     */
    public function test_sort_with_user_fields()
    {
        $this->newInstanceOfClass = new ListActions(User::class, 'users');
        $this->assertIsObject($this->newInstanceOfClass->sortWithUserFields());
    }
}
