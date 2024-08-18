<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\TickerFactory>
 */
class TickerFactory extends Factory
{

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        return [
            
            'counter' => $this->faker->numberBetween(1, 100),
            'tag' => $this->faker->word,
            'description' => $this->faker->sentence,
            'status' => $this->faker->randomElement([0, 1]),
            
        ];

       
    }

    
}
