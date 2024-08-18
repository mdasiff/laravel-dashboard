<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Candidate>
 */
class CandidateFactory extends Factory
{

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'position_id'=>1,
            'name'=>fake()->name(),
            'email'=>fake()->unique()->safeEmail(),
            'phone'=>1234567890,
            'total_experience'=>1,
            'dob'=>now(),
            'location'=>'Delhi',
            'resume'=>'file.pdf'  
        ];

       
    }

    
}
