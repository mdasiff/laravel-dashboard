<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Blog>
 */
class BlogFactory extends Factory
{

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $title = 'blog 1' . time();
        $slug = Str::slug($title);

        return [
            'blog_category_id'=>1,
            'title'=>$title,
            'slug'=>$slug,
            'status'=>1
        ];

       
    }

    
}
