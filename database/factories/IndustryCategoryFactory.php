<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\IndustryCategory>
 */
class IndustryCategoryFactory extends Factory
{

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name'=>fake()->name(),
            'slug'=>fake()->name(),
            'description'=>fake()->name(),
            'image'=>'abc.jpg',
            'image_alt'=>'abc',
            'meta_tag_title'=>fake()->name(),
            'meta_tag_keywords'=>fake()->name(),
            'meta_tag_description'=>fake()->name(),
            'sort'=>1,
            'status'=>1  
        ];

       
    }

    
}
