<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\TestimonialFactory>
 */
class TestimonialFactory extends Factory
{

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        return [
            
            'name' => $this->faker->word,
            'type' => 'text',
            'location' => $this->faker->address,
            'image' => $this->faker->imageUrl(640, 480, 'events'),
            'image_alt' => $this->faker->word,
            'message' => $this->faker->text,
            'status' => $this->faker->boolean,
            'show_on_home_page' => $this->faker->boolean,
            'sort' => $this->faker->numberBetween(1, 100),
            'created_at' => now(),
            'updated_at' => now(),
            'video' => $this->faker->url,
            'meta_tag_title' => $this->faker->word,
            'meta_tag_keywords' => $this->faker->words(3, true),
            'meta_tag_description' => $this->faker->word,
            
        ];

       
    }

    
}
