<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ResourceCategoryFactory>
 */
class ResourceCategoryFactory extends Factory
{

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        return [
            
            'name' => $this->faker->words(3, true),
            'description' => $this->faker->word,
            'slug' => Str::slug($this->faker->unique()->words(3, true)),
            'image' => $this->faker->imageUrl(640, 480, 'business', true, 'Faker'),
            'image_alt' => $this->faker->words(3, true),
            'sort' => $this->faker->numberBetween(1, 100),
            'status' => 1,
            'meta_tag_title' => $this->faker->word,
            'meta_tag_keywords' => implode(', ', $this->faker->words(5)),
            'meta_tag_description' => $this->faker->word,
            
        ];

       
    }

    
}
