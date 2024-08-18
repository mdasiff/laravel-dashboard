<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ServiceFactory>
 */
class ServiceFactory extends Factory
{

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        return [
            
            'service_category_id' => \App\Models\ServiceCategory::factory(),
            'name' => $this->faker->word,
            'slug' => $this->faker->slug,
            'image' => $this->faker->imageUrl(), // Use a URL to a fake image
            'image_alt' => $this->faker->word,
            'file' => $this->faker->filePath(), // Use a fake file path
            'description' => $this->faker->word,
            'status' => $this->faker->boolean,
            'sort' => $this->faker->numberBetween(1, 10),
            'meta_tag_title' => $this->faker->word,
            'meta_tag_keywords' => $this->faker->words(3, true),
            'meta_tag_description' => $this->faker->word,
        ];

       
    }

    
}
