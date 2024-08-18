<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Location>
 */
class LocationFactory extends Factory
{

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        return [
            'title'=>fake()->name(),
            'address_1'=>fake()->name(),
            'address_2'=>fake()->name(),
            'city'=>fake()->name(),
            'country_id'=>1,
            'zip'=>1111,
            'phone'=>1234567890,
            'fax'=>1234,
            'status'=>1
        ];

       
    }

    
}
