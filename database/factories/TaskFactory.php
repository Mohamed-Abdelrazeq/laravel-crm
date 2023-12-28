<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class TaskFactory extends Factory
{
    public function definition(): array
    {
        $createdAt = $this->faker->dateTimeBetween('-1 year', 'now');
        $updatedAt = $this->faker->dateTimeBetween($createdAt, 'now');

        return [
            'title' => $this->faker->sentence(1),
            'description' => $this->faker->paragraph(10),
            'status' => $this->faker->randomElement(['todo', 'in_progress', 'done']),
            'assignee_id' => $this->faker->numberBetween(1, 50),
            'reporter_id' => $this->faker->numberBetween(1, 50),
            'project_id' => $this->faker->numberBetween(1, 5),
            'created_at' => $createdAt,
            'updated_at' => $updatedAt,
        ];
    }
}
