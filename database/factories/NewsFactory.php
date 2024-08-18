<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\News>
 */
class NewsFactory extends Factory
{

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        return [
            
            'title' => fake()->sentence,
            'tag' => fake()->word,
            'slug' => function (array $attributes) {
                return Str::slug($attributes['title']);
            },
            'image' => $this->faker->imageUrl(800, 600, 'nature', true, 'Faker'),
            'image_alt' => $this->faker->words(3, true),
            'thumbnail' => $this->faker->imageUrl(400, 300, 'nature', true, 'Faker'),
            'thumbnail_alt' => $this->faker->words(3, true),
            'short_description' => $this->faker->text(150),
            'description' => $this->faker->words(3, true),
            'status' => $this->faker->boolean,
            'sort' => $this->faker->numberBetween(1, 100),
            
        ];

       
    }

    
}
