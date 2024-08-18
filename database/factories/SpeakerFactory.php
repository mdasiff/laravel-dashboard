<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\SpeakerFactory>
 */
class SpeakerFactory extends Factory
{

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        return [
            
            'name' => $this->faker->name,
            'email' => $this->faker->unique()->safeEmail,
            'designation' => $this->faker->jobTitle,
            'image' => $this->faker->imageUrl(640, 480, 'people', true, 'Faker', true),
            'image_alt' => $this->faker->word,
            
        ];

       
    }

    
}
