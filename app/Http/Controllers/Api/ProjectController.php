<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProjectResource;
use App\Models\Project;
use App\Models\User;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:sanctum');
        $this->authorizeResource(Project::class, 'project');

    }

    public function index()
    {
        return ProjectResource::collection(
            User::find(request()->user()->id)
                ->projects()
                ->paginate(10)
        );
    }

    public function store(Request $request)
    {
        // Validate request.users
        $users =
            $request->validate([
                'users' => 'sometimes|array',
                'users.*' => 'sometimes|integer',
            ])['users'] ?? [];
        array_push($users, request()->user()->id);

        // Create project
        $project = Project::create([
            // Validate request
            ...$request->validate([
                'title' => 'required|string|max:255',
                'description' => 'required|string|max:1000',
            ]),
            'owner_id' => request()->user()->id,
            'users' => $users,
        ]);

        // Attach users to projects_users
        $project->users()->attach($users);

        // Return response
        return response()->json([
            'message' => 'Project created successfully',
            'project' => new ProjectResource($project->load(['tasks', 'users']))
        ]);
    }

    public function show(Project $project)
    {
        return new ProjectResource(
            $project->load(['tasks', 'users'])
        );
    }

    public function update(Request $request, Project $project)
    {
        // Update project
        $project->update([
            // Validate request
            ...$request->validate([
                'title' => 'sometimes|string|max:255',
                'description' => 'sometimes|string|max:1000',
                'users' => 'sometimes|array',
            ]),
        ]);

        // Return response
        return response()->json([
            'message' => 'Project updated successfully',
            'project' => new ProjectResource($project->load(['tasks', 'users']))
        ]);
    }

    public function destroy(Project $project)
    {
        $project->delete();
        return response()->json([
            'message' => 'Project deleted successfully'
        ]);
    }
}
