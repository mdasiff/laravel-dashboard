<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\ResourceCategory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ResourceFactory>
 */
class ResourceFactory extends Factory
{

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        return [
            
            'resource_category_id' => ResourceCategory::factory(),
            'name' => $this->faker->word,
            'image' => $this->faker->imageUrl(640, 480, 'cats'),
            'image_alt' => $this->faker->word,
            'home_image' => $this->faker->imageUrl(640, 480, 'cats'),
            'home_image_alt' => $this->faker->word,
            'file' => $this->faker->word . '.pdf',
            'description' => $this->faker->word,
            'status' => $this->faker->boolean,
            'show_on_home_page' => $this->faker->boolean,
            'sort' => $this->faker->numberBetween(1, 100),
            
        ];

       
    }

    
}
