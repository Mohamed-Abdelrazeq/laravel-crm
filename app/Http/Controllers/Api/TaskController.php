<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\TaskResource;
use App\Models\Project;
use App\Models\Tag;
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
        return TaskResource::collection($project->tasks()->paginate(10));
    }

    public function store(Request $request, Project $project)
    {
        // PARSE DATA
        $data = $request->validate([
            'title' => 'required|max:255',
            'description' => 'required|max:1000',
            'status' => 'sometimes|in:todo,in_progress,done,tested,deployed',
            'assigned_to' => 'sometimes',
            'tags' => 'sometimes|array',
        ]);
        $tags = $data['tags'] ?? [];

        // VALIDATE THE TAGS
        if (!$this->isValidTags($request, $project, $tags)) {
            return response()->json([
                'message' => 'Invalid tags',
            ], 422);
        }

        // CREATE THE TASK
        $task = $project->tasks()->create([
            ...$data,
            'created_by' => $request->user()->id,
            'project_id' => $project->id,
        ]);

        // ATTACH THE TAGS
        $task->tags()->attach($tags);

        // RETURN THE TASK
        return new TaskResource($task);
    }

    public function show(Project $project, Task $task)
    {
        return new TaskResource($task);
    }

    public function update(Request $request, Project $project, Task $task)
    {
        // PARSE DATA
        $data = $request->validate([
            'title' => 'sometimes|max:255',
            'description' => 'sometimes|max:1000',
            'status' => 'sometimes|in:todo,in_progress,done,tested,deployed',
            'assigned_to' => 'sometimes',
            'tags' => 'sometimes|array',
        ]);
        $tags = $data['tags'] ?? $task->tags->pluck('id')->toArray();

        // VALIDATE THE TAGS
        if (!$this->isValidTags($request, $project, $tags)) {
            return response()->json([
                'message' => 'Invalid tags',
            ], 422);
        }

        // UPDATE THE TASK
        $task->update($data);

        // SYNC THE TAGS
        $task->tags()->sync($tags);

        // RETURN THE TASK
        return new TaskResource($task);
    }

    public function destroy(Project $project, Task $task)
    {
        $task->delete();
        return response()->json([
            'message' => 'Task deleted successfully',
        ]);
    }

    protected function isValidTags(Request $request, Project $project, $tags): bool
    {
        return $project->tags()->whereIn('id', $tags)->count() === count($tags);
    }
}
