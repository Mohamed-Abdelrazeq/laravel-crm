<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ProjectFactory extends Factory
{
    public function definition(): array
    {
        $createdAt = $this->faker->dateTimeBetween('-1 year', 'now');
        $updatedAt = $this->faker->dateTimeBetween($createdAt, 'now');
        return [
            'title' => $this->faker->unique()->sentence(1),
            'description' => $this->faker->paragraph(10),
            'owner_id' => $this->faker->numberBetween(1, 100),
            'created_at' => $createdAt,
            'updated_at' => $updatedAt,
        ];
    }
}
