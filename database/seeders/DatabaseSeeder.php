<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        \App\Models\User::factory(100)->create();
        \App\Models\Project::factory(10)->create();
        \App\Models\Task::factory(1000)->create();

        \App\Models\Project::all()->each(function ($project) {
            $project->users()->sync($project->user_id);
            $project->users()->syncWithoutDetaching(\App\Models\User::all()->random(10));
        });
    }
}
