<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ProductCategory>
 */
class ProductCategoryFactory extends Factory
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
            'description' => $this->faker->text,
            'slug' => function (array $attributes) {
                return Str::slug($attributes['name']);
            },
            'image' => $this->faker->imageUrl(),
            'sort' => $this->faker->numberBetween(1, 100),
            'status' => $this->faker->boolean,
            'row' => 1,
            'meta_tag_title' => $this->faker->word,
            'meta_tag_keywords' => $this->faker->words(3, true),
            'meta_tag_description' => $this->faker->word
            
        ];

       
    }

    
}
