<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\AttendanceResource;
use App\Models\Attendance;
use App\Models\Project;
use App\Models\User;
use Illuminate\Http\Request;

class AttendanceController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:sanctum');
        $this->authorizeResource(Attendance::class, 'attendance');
    }

    public function index(Project $project)
    {
        return AttendanceResource::collection(
            $project->attendances()->where('user_id', request()->user()->id)->paginate(10)
        );
    }

    public function store(Request $request, Project $project)
    {
        $validatedData = $request->validate([
            "clock_in" => "required|date",
            "clock_out" => "sometimes|date",
        ]);

        $attendance = Attendance::create([
            ...$validatedData,
            'user_id' => request()->user()->id,
            'project_id' => $project->id,
        ]);

        return new AttendanceResource($attendance);
    }

    public function show(Attendance $attendance)
    {
        return new AttendanceResource($attendance);
    }

    public function update(Request $request, Project $project, Attendance $attendance)
    {
        $validatedData = $request->validate([
            "clock_in" => "sometimes|date",
            "clock_out" => "sometimes|date",
        ]);

        $attendance->update([
            ...$validatedData,
            "project_id" => $project->id,
        ]);

        return $attendance;
    }

    public function destroy(Attendance $attendance)
    {
        $attendance->delete();
        return response()
            ->json([
                'message' => 'Attendance deleted successfully'
            ]);
    }
}
