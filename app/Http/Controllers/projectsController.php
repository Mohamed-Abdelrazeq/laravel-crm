<?php

namespace App\Http\Controllers;

use App\Models\project;
use Illuminate\Http\Request;

class projectsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return project::paginate(5);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(project $project)
    {
        return $project;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
