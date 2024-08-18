<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Navigation>
 */
class NavigationFactory extends Factory
{

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        return [
            'parent_id'=>1,
            'main_menu_id'=>1,
            'name'=>fake()->name(),
            'type'=>'abc',
            'link'=>'asif',
            'file'=>'abcd',
            'status'=>1,
            'sort'=>1,
            'level'=>1
        ];

       
    }

    
}
