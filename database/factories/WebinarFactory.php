<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\WebinarFactory>
 */
class WebinarFactory extends Factory
{

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        return [
            
            'speaker_id' => \App\Models\Speaker::factory(),
            'title' => $this->faker->word,
            'industry' => $this->faker->word,
            'webinar_date' => $this->faker->date(),
            'timezone_id' => $this->faker->numberBetween(1, 24),
            'global_zone' => $this->faker->timezone,
            'synopsis' => $this->faker->word,
            'youtube' => $this->faker->url,
            'status' => $this->faker->randomElement([0, 1]),
            'meta_tag_title' => $this->faker->word,
            'meta_tag_keywords' => $this->faker->words(5, true),
            'meta_tag_description' => $this->faker->word, 
            
        ];

       
    }

    
}
