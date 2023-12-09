<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\TaskResource;
use App\Models\Project;
use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:sanctum');
        $this->authorizeResource(Task::class, 'task');
    }
    public function index(Project $project)
    {
        return TaskResource::collection($project->tasks);
    }

    public function store(Request $request, Project $project)
    {
        // VALIDATE THAT ASSIGNED TO IS A USER IN THE PROJECT
        $task = $project->tasks()->create([
            ...$request->validate(
                [
                    'title' => 'required|max:255',
                    'description' => 'required|max:1000',
                    'status' => 'sometimes|in:todo,in_progress,done,tested,deployed',
                    'assigned_to' => 'sometimes',
                ],
            ),
            'created_by' => $request->user()->id,
            'project_id' => $project->id,
        ]);
        return new TaskResource($task);
    }

    public function show(Project $project, Task $task)
    {
        return new TaskResource($task);
    }

    public function update(Request $request, Project $project, Task $task)
    {
        $task->update([
            ...$request->validate(
                [
                    'title' => 'sometimes|max:255',
                    'description' => 'sometimes|max:1000',
                    'status' => 'sometimes|in:todo,in_progress,done,tested,deployed',
                    'assigned_to' => 'sometimes',
                ],
            ),
        ]);
        return new TaskResource($task);
    }

    public function destroy(Task $task)
    {
        //
    }
}
