<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\Webinar;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\TimezoneFactory>
 */
class TimezoneFactory extends Factory
{

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        return [
            
            'country_code' => $this->faker->countryCode,
            'country_name' => $this->faker->country,
            'time_zone' => $this->faker->timezone,
            'gmt_offset' => $this->faker->numberBetween(-12, 14),
            'time_zone_abbr' => $this->faker->randomElement(['GMT', 'UTC', 'CST', 'EST', 'PST']),
            
        ];

       
    }

    
}
