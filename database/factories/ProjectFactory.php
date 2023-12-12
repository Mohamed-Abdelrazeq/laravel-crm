<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ProjectFactory extends Factory
{
    public function definition(): array
    {
        return [
            'title' => $this->faker->unique()->sentence(1),
            'description' => $this->faker->sentence(10),
            'user_id' => $this->faker->numberBetween(1, 100)
        ];
    }
}
