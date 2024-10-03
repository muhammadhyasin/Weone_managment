<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Order>
 */
class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'product_item_no' => $this->faker->unique()->numerify('ITEM###'),
            'product_name' => $this->faker->word(),
            'customer_name' => $this->faker->name(),
            'address' => $this->faker->address(),
            'phone_number' => $this->faker->phoneNumber(),
            'postcode' => $this->faker->postcode(),
            'delivery_date' => $this->faker->date(),
            'delivery_start_time' => $this->faker->time(),
            'delivery_end_time' => $this->faker->time(),
            'price' => $this->faker->randomFloat(2, 10, 1000), // Price between 10 and 1000
            'created_by' => $this->faker->userName(),
            'updated_by' => $this->faker->userName(),
            'order_status' => $this->faker->randomElement(['pending', 'Completed', 'canceled']),
            'payment_method' => $this->faker->randomElement(['credit_card', 'paypal', 'bank_transfer']),
            'payment_status' => $this->faker->randomElement(['pending', 'Completed']),
        ];
    }
}
