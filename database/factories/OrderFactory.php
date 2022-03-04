<?php

namespace Database\Factories;

use App\Models\Order;
use App\Models\User;
use App\Models\Payment;
use App\Models\Product;
use App\Models\OrderStatus;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class OrderFactory extends Factory
{

    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Order::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $amount = $this->faker->randomFloat(2, 0, 10000);
        $deliveryFee = ($amount > 500) ? 0 : 15;

        $statusId = OrderStatus::factory()->create()->id;
        $status = OrderStatus::find($statusId);

        $paymentId = ($status->title === 'paid' || $status->title === 'shipped') ? Payment::factory()->create()->id : null;
        $shipped_at = ($status->title === 'shipped') ? $status->updated_at : null;

        return [
            'user_id' => User::all()->random()->id,
            'order_status_id' => $statusId,
            'payment_id' => $paymentId,
            'uuid' => Str::uuid(),
            'products' =>  json_encode([
                "product" => Product::all()->random()->uuid,
                "quantity" => $this->faker->randomNumber(1, 50)
            ]),
            'address' => json_encode([
                'billing' => $this->faker->address(),
                'shipping' => $this->faker->address()
            ]),
            'delivery_fee' => $deliveryFee,
            'amount' => $amount,
            'shipped_at' =>  $shipped_at,
        ];
    }
}
