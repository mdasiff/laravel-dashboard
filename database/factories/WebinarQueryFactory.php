<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\WebinarQueryFactory>
 */
class WebinarQueryFactory extends Factory
{

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        return [
            
            'webinar_id' => 1,
            'first_name' => $this->faker->firstName,
            'last_name' => $this->faker->lastName,
            'email' => $this->faker->unique()->safeEmail,
            'contact' => $this->faker->phoneNumber,
            'company' => $this->faker->company,
            'job_title' => $this->faker->jobTitle,
            'country' => $this->faker->country,
            'message' => $this->faker->word,
            'notified' => $this->faker->boolean,
            
        ];

       
    }

    
}
