<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\Resource;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ResourceQueryFactory>
 */
class ResourceQueryFactory extends Factory
{

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        return [
            
            'resource_id' => Resource::factory(),
            'first_name' => $this->faker->firstName,
            'last_name' => $this->faker->lastName,
            'email' => $this->faker->unique()->safeEmail,
            'contact' => $this->faker->phoneNumber,
            'company' => $this->faker->company,
            'job_title' => $this->faker->jobTitle,
            'country' => $this->faker->country,
            'notified' => $this->faker->boolean,
            
        ];

       
    }

    
}
