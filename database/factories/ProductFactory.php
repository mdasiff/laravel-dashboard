<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        return [
            
            'product_category_id' => $this->faker->randomNumber(),
            'name' => $this->faker->word,
            'slug' => $this->faker->slug,
            'image' => $this->faker->imageUrl($width = 640, $height = 480, 'category'),
            'description' => $this->faker->word,
            'status' => $this->faker->boolean,
            'sort' => $this->faker->numberBetween(1, 100),
            'meta_tag_title' => $this->faker->word,
            'meta_tag_keywords' => $this->faker->words(5, true),
            'meta_tag_description' => $this->faker->word,
            
        ];

       
    }

    
}
