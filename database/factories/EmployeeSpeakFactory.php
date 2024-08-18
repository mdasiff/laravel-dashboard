<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\EmployeeSpeak>
 */
class EmployeeSpeakFactory extends Factory
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
            'designation'=>fake()->name(),
            'image'=>'abc.jpg',
            'description'=>fake()->name(),
            'sort'=>1,
            'status'=>1  
        ];

       
    }

    
}
