<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\BlogPost>
 */
class BlogPostFactory extends Factory
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
            'blog_id'=>1,
            'heading'=>$title,
            'post'=>'data',
            'status'=>1,
            'sort'=>1
        ];

       
    }

    
}
