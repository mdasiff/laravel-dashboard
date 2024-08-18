<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\BlogCategory>
 */
class BlogCategoryFactory extends Factory
{

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $title = 'blog cat ' . time();
        $slug = Str::slug($title);

        return [
            'title' => $title,
            'slug' => $slug,
            'status' => 1,
            'sort' => 1
        ];

       
    }

    
}
