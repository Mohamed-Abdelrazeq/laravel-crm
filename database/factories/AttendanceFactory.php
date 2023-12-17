<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Attendance>
 */
class AttendanceFactory extends Factory
{
    public function definition(): array
    {
        $clockIn = $this->faker->dateTimeBetween('-1 week', 'now');
        $clockOut = $this->faker->dateTimeBetween($clockIn, $clockIn->format('Y-m-d H:i:s') . ' + 8 hours');

        return [
            'user_id' => $this->faker->numberBetween(1, 100),
            'clock_in' => $clockIn,
            'clock_out' => $clockOut,
        ];
    }
}
