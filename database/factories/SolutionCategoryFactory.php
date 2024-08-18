<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\SolutionCategoryFactory>
 */
class SolutionCategoryFactory extends Factory
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
            'description' => $this->faker->word,
            'slug' => Str::slug($this->faker->word),
            'image' => $this->faker->imageUrl(640, 480, 'cats', true, 'Faker'),
            'image_alt' => $this->faker->word,
            'sort' => $this->faker->numberBetween(1, 100),
            'status' => $this->faker->boolean,
            'meta_tag_title' => $this->faker->word,
            'meta_tag_keywords' => $this->faker->words(5, true),
            'meta_tag_description' => $this->faker->word,
            
        ];

       
    }

    
}
