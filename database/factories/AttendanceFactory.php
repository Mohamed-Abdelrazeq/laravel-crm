<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class AttendanceFactory extends Factory
{
    public function definition(): array
    {
        $clockIn = $this->faker->dateTimeBetween('-1 week', 'now');
        $clockOut = $this->faker->dateTimeBetween($clockIn->format('Y-m-d H:i:s') . ' + 4 hours', $clockIn->format('Y-m-d H:i:s') . ' + 8 hours');

        return [
            'user_id' => $this->faker->numberBetween(1, 100),
            'clock_in' => $clockIn,
            'clock_out' => $clockOut,
            'project_id' => $this->faker->numberBetween(1, 5),
        ];
    }
}
