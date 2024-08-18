<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\Webinar;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\WebinarUserFactory>
 */
class WebinarUserFactory extends Factory
{

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        return [
            
            'webinar_id' => Webinar::factory(),
            'fname' => $this->faker->firstName,
            'lname' => $this->faker->lastName,
            'phone' => 1234567890,
            'email' => $this->faker->unique()->safeEmail,
            'job_title' => $this->faker->jobTitle,
            'company' => $this->faker->company,
            'country' => $this->faker->country,
            'message' => $this->faker->word,
            
        ];

       
    }

    
}
