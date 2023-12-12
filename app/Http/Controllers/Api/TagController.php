<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\TagResource;
use App\Models\Project;
use App\Models\Tag;
use Illuminate\Http\Request;

class TagController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:sanctum');
        $this->authorizeResource(Tag::class, 'tag');
    }
    public function index(Project $project)
    {
        return TagResource::collection($project->tags);
    }

    public function store(Request $request, Project $project)
    {
        $tag = $project->tags()->create([
            ...$request->validate([
                'name' => 'required|string|max:255',
            ]),
            'project_id' => $project->id,
        ]);

        return new TagResource($tag);
    }

    public function show(Project $project, Tag $tag)
    {
        return new TagResource($tag);
    }

    public function update(Request $request, Project $project, Tag $tag)
    {
        $tag->update([
            ...$request->validate([
                'name' => 'sometimes|string|max:255',
            ]),
        ]);

        return new TagResource($tag);
    }

    public function destroy(Project $project, Tag $tag)
    {
        $tag->delete();

        return response()->json(['message' => 'Tag deleted successfully'], 200);
    }
}
