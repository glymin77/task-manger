<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index()
    {
        $tasks = Task::all();
        return view('home', compact('tasks'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:255',
            'description' => 'nullable',
        ]);

        Task::create([
            'title' => $request->title,
            'description' => $request->description,
            'is_completed' => false,
        ]);

        return redirect()->back()->with('success', 'Task created successfully!');
    }

    public function destroy($id)
{
        $task = Task::findOrFail($id);
        $task->delete();
        return redirect()->back()->with('success', 'Task deleted successfully!');
}

    public function toggle($id)
{
        $task = Task::findOrFail($id);
        $task->is_completed = !$task->is_completed;
        $task->save();
        return redirect()->back()->with('success', 'Task updated Successfully!');
}

    // Public API endpoint to get all tasks
    public function apiIndex()
    {
        return response()->json(Task::all());
    }
}
