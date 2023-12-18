<?php

namespace Database\Seeders;

use App\Models\Project;
use App\Models\Tag;
use App\Models\Task;
use App\Models\User;
use Illuminate\Database\Seeder;



class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // I will start with strong entities first (USERS, PROJECTS)
        User::factory(50)->create();
        Project::factory(5)->create(['owner_id' => User::all()->random()->id]);
        // I will add owner to the users and add 4 more users
        Project::all()->each(function (Project $project) {
            $project->users()->attach($project->owner_id);
            $project->users()->syncWithoutDetaching(User::all()->random(4));
        });

        // ->create(['project_id' => 1]);
        // I will add 3 tags to each project
        Project::all()->each(function (Project $project) {
            Tag::factory(3, ['project_id' => $project->id])->create();
        });
        // Project::all()->each(function (Project $project) {
        //     $project->tags()->syncWithoutDetaching(Tag::factory(3)->create()->pluck('id'));
        // });

        // // I will add 20 tasks to each project and assign them to random users
        // Project::all()->each(function (Project $project) {
        //     Task::factory(20)->create(['project_id' => $project->id])->each(function (Task $task) use ($project) {
        //         $task->users()->attach($project->users()->inRandomOrder()->first()->id);
        //         $task->tags()->attach($project->tags()->inRandomOrder()->first()->id);
        //     });
        // });


    }
}
