<?php

namespace Database\Factories;

use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\StockTransactions>
 */
class StockTransactionsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'product_id' => Product::factory(), // Asumsikan Anda juga memiliki factory untuk Product
            'user_id' => User::factory(), // Asumsikan Anda juga memiliki factory untuk User
            'type' => $this->faker->randomElement(['Masuk', 'Keluar']),
            'quantity' => $this->faker->numberBetween(1, 100),
            'date' => $this->faker->date(),
            'status' => $this->faker->randomElement(['Pending', 'Diterima', 'Ditolak', 'Dikeluarkan']),
            'notes' => $this->faker->sentence(),
        ];
    }
}
