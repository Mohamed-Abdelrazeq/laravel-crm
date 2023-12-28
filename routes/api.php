<?php

use App\Http\Controllers\Api\AttendanceController;
use App\Http\Controllers\Api\ProjectController;
use App\Http\Controllers\Api\TaskController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Api\TagController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])
    ->middleware('auth:sanctum');

Route::apiResource('projects', ProjectController::class);

Route::apiResource('projects.tasks', TaskController::class)
    ->scoped();

Route::apiResource('projects.tags', TagController::class)
    ->scoped();

Route::apiResource('project.attendance', AttendanceController::class)
    ->scoped();
