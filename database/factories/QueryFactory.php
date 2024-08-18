<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\QueryFactory>
 */
class QueryFactory extends Factory
{

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        return [
            
            'fname' => $this->faker->firstName,
            'lname' => $this->faker->lastName,
            'email' => $this->faker->unique()->safeEmail,
            'company' => $this->faker->company,
            'job_title' => $this->faker->jobTitle,
            'country' => $this->faker->country,
            'message' => $this->faker->word,
            
        ];

       
    }

    
}
