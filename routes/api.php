<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Task;

Route::middleware('throttle:api')->group(function () {
    Route::get('/tasks', function () {
        $tasks = Task::all();
        return response()->json($tasks);
    });
});
