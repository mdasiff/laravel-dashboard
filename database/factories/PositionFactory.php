<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Position>
 */
class PositionFactory extends Factory
{

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        return [
            
            'title' => $this->faker->jobTitle,
            'slug' => Str::slug($this->faker->unique()->sentence(3)),
            'description' => $this->faker->word,
            'location' => $this->faker->city,
            'duration' => $this->faker->numberBetween(1, 12) . ' months',
            'vacancy' => $this->faker->numberBetween(1, 10),
            'experience' => $this->faker->numberBetween(1, 20) . ' years',
            'sort' => $this->faker->numberBetween(1, 100),
            'status' => $this->faker->boolean
            
        ];

       
    }

    
}
