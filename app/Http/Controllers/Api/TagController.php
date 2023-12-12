<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Tag;
use Illuminate\Http\Request;

class TagController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:sanctum');
        $this->authorizeResource(Tag::class, 'tag');
    }
    public function index()
    {
        return response()->json([
            'message' => 'Hello from TagController'
        ]);
    }

    public function store(Request $request)
    {
        //
    }

    public function show(string $id)
    {
        //
    }

    public function update(Request $request, string $id)
    {
        //
    }

    public function destroy(string $id)
    {
        //
    }
}
