<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\Webinar;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\WebinarTestimonialFactory>
 */
class WebinarTestimonialFactory extends Factory
{

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        return [
            
            'webinar_id' => 1,
            'name' => $this->faker->word,
            'location' => $this->faker->city,
            'image' => $this->faker->imageUrl(),
            'image_alt' => $this->faker->word,
            'message' => 'this is fake message',
            'status' => 1,
            'sort' => $this->faker->numberBetween(1, 100),
            
        ];

       
    }

    
}
