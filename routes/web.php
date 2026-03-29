<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;

// Welcome page (not protected)
Route::get('/', function () {
    return view('welcome');
});

// Dashboard page (protected by auth)
Route::get('/dashboard', [TaskController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');

// Profile routes (for user profile management)
Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Task routes (for your Task Manager)
Route::middleware(['auth'])->group(function () {
    Route::get('/tasks', [TaskController::class, 'index'])->name('tasks.index');
    Route::post('/tasks', [TaskController::class, 'store'])->name('tasks.store');
    Route::delete('/tasks/{id}', [TaskController::class, 'destroy'])->name('tasks.destroy');
    Route::patch('/tasks/{id}/toggle', [TaskController::class, 'toggle'])->name('tasks.toggle');
});
// Public API endpoints

Route::get('/api/tasks', [TaskController::class, 'apiIndex'])->name('api.tasks.index');

require __DIR__.'/auth.php';


