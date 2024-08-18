<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Banner>
 */
class BannerFactory extends Factory
{

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => fake()->name(),
            'subtitle' => rand(3,4),
            'link' => rand(1,2),
            'status' => 1,
            'image_alt' => rand(5,6),
            'cta_text' => rand(7,8),
            'sort' => 1,
            'image' => fake()->name(),
            'image_mobile' => fake()->name()
        ];

       
    }

    
}
