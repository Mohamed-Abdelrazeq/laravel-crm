<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:sanctum')->except(['index', 'show']);
    }

    public function index()
    {
        return project::paginate(5);
    }

    public function store(Request $request)
    {
        $project = Project::create([
            ...$request->validate([
                'title' => 'required|string|max:255',
                'description' => 'required|string|max:1000',
            ]),
            'user_id' => 1,
        ]);
        return response()->json([
            'message' => 'Project created successfully',
            'project' => $project
        ]);
    }

    public function show(project $project)
    {
        return $project;
    }

    public function update(Request $request, project $project)
    {
        $project->update([
            ...$request->validate([
                'title' => 'sometimes|string|max:255',
                'description' => 'sometimes|string|max:1000',
            ]),
            'user_id' => 1,
        ]);
        return response()->json([
            'message' => 'Project updated successfully',
            'project' => $project
        ]);
    }

    public function destroy(project $project)
    {
        $project->delete();
        return response()->json([
            'message' => 'Project deleted successfully'
        ]);
    }
}
