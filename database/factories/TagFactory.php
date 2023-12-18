<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class TagFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name' => $this->faker->unique()->word(),
            'color' => $this->faker->randomElements(['red', 'blue', 'green', 'yellow', 'purple', 'indigo', 'pink', 'gray']),
            'project_id' => $this->faker->numberBetween(1, 5)
        ];
    }
}
