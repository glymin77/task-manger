<?php

use App\Http\Controllers\TaskController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Task;

Route::middleware('throttle:api')->group(function () {
    Route::get('/tasks', [TaskController::class, 'index']
    );
});