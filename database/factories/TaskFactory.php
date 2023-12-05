<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\task>
 */
class TaskFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence(3),
            'description' => $this->faker->sentence(10),
            'status' => $this->faker->randomElement(['todo', 'in_progress', 'done', 'tested', 'deployed']),
            'assigned_to' => $this->faker->numberBetween(1, 100),
            'created_by' => $this->faker->numberBetween(1, 100),
            'project_id' => $this->faker->numberBetween(1, 10),
        ];
    }
}
