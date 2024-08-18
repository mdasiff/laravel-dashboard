<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\CareerQueryFactory>
 */
class CareerQueryFactory extends Factory
{

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        return [
            
            'file' => $this->faker->file('/tmp', '/var/tmp', false),
            'name' => $this->faker->name,
            'email' => $this->faker->unique()->safeEmail,
            'contact' => $this->faker->phoneNumber,
            'position' => $this->faker->jobTitle,
            'relative' => $this->faker->name,
            'dob' => $this->faker->dateOfBirth,
            'location' => $this->faker->city,
            'notified' => $this->faker->boolean,
            
        ];

       
    }

    
}
