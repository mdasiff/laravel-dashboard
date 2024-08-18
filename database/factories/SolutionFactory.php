<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\SolutionCategory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\SolutionFactory>
 */
class SolutionFactory extends Factory
{

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        return [
            
            'solution_category_id' => SolutionCategory::factory(),
            'name' => $this->faker->word,
            'slug' => $this->faker->slug,
            'image' => $this->faker->imageUrl(), // Or adjust to your image path/format
            'image_alt' => $this->faker->sentence,
            'file' => $this->faker->filePath(), // Adjust based on your file handling
            'description' => $this->faker->paragraph,
            'status' => $this->faker->boolean,
            'sort' => $this->faker->numberBetween(1, 100),
            'created_at' => $this->faker->dateTimeThisDecade(),
            'updated_at' => $this->faker->dateTimeThisDecade(),
            'meta_tag_title' => $this->faker->sentence,
            'meta_tag_keywords' => $this->faker->words(5, true),
            'meta_tag_description' => $this->faker->sentence,
            
        ];

       
    }

    
}
