<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Industry>
 */
class IndustryFactory extends Factory
{

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $title = 'title 1' . time();
        $slug = Str::slug($title);

        return [
            'industry_category_id'=>1,
            'file'=>'abc.pdf',
            'name'=>$title,
            'slug'=>$slug,
            'description'=>$title,
            'meta_tag_title'=>$title,
            'meta_tag_keywords'=>$title,
            'meta_tag_description'=>$title,
            'sort'=>1,
            'status'=>1  
        ];

       
    }

    
}
