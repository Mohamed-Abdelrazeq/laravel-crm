<?php

namespace App\Http\Controllers;

use App\Models\project;
use Illuminate\Http\Request;

class projectsController extends Controller {
    public function index() {
        return project::paginate(5);
    }

    public function store(Request $request) {
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

    public function show(project $project) {
        return $project;
    }

    public function update(Request $request, string $id) {
        //
    }

    public function destroy(project $project) {
        $project->delete();
        return response()->json([
            'message' => 'Project deleted successfully'
        ]);
    }
}
