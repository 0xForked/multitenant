<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class TenantFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->shuffleString,
            'domain' =>  $this->faker->shuffleString,
            'database' => $this->faker->shuffleString
        ];
    }
}
