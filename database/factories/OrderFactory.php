<?php

namespace Database\Factories;

use App\Models\Order;
use App\Models\Coupon;
use App\Models\User;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Factories\Factory;

class OrderFactory extends Factory
{
    use HasFactory;
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
        return [
            'user_id' => function(){
                return User::factory()->create()->id;
            },
            'product_id' => function () {
                return Product::factory()->create()->id;
                // ->state('starter')

            },

            'stripe_id' => $this->faker->word,
            'coupon_id' => function(){
                return Coupon::factory()->create()->id;
            },
            'total' => $this->faker->randomFloat(2,1,100),
        ];
    }
}
