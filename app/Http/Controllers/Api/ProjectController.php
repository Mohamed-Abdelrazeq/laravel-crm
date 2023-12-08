<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProjectResource;
use App\Models\Project;
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
        return ProjectResource::collection(request()->user()->projects->load(['tasks', 'users']));
    }

    public function store(Request $request)
    {
        // Create Project
        $project = Project::create([
            ...$request->validate([
                'title' => 'required|string|max:255',
                'description' => 'required|string|max:1000',
            ]),
            'user_id' => request()->user()->id,
            'users' => [request()->user()->id],
        ]);

        // Attach owner to project
        $project->users()->attach(request()->user()->id);

        return response()->json([
            'message' => 'Project created successfully',
            'project' => $project
        ]);
    }

    public function show(Project $project)
    {
        return Project::with(['tasks', 'users'])->findOrFail($project->id);
    }

    public function update(Request $request, Project $project)
    {
        $project->update([
            ...$request->validate([
                'title' => 'sometimes|string|max:255',
                'description' => 'sometimes|string|max:1000',
            ]),
            'user_id' => request()->user()->id,
        ]);
        return response()->json([
            'message' => 'Project updated successfully',
            'project' => $project
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
