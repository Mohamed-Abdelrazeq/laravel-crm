<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
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
        return request()->user()->projects;
    }

    public function store(Request $request)
    {
        $project = Project::create([
            ...$request->validate([
                'title' => 'required|string|max:255',
                'description' => 'required|string|max:1000',
            ]),
            'user_id' => request()->user()->id,
        ]);
        return response()->json([
            'message' => 'Project created successfully',
            'project' => $project
        ]);
    }

    public function show(Project $project)
    {

        return $project;
        // return Project::findOrFail($id);
        // return Project::with(['tasks', 'users'])->findOrFail($id);
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
