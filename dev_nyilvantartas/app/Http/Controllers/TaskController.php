<?php

// app/Http/Controllers/TaskController.php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class TaskController extends Controller
{
    public function create()
    {
        $user = auth()->user();

        // Check if the user has admin status
        if ($user->status !== 'admin') {
            Log::error('User does not have admin status', ['user_id' => $user->id, 'status' => $user->status]);
            abort(403, 'Unauthorized action.');
        }

        // Display the form to create tasks
        return view('tasks.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string', // Add or adjust validation for description
        ]);

        $user = auth()->user();

        // Check if the user has admin status
        if ($user->status !== 'admin') {
            Log::error('User does not have admin status', ['user_id' => $user->id, 'status' => $user->status]);
            abort(403, 'Unauthorized action.');
        }
        //dd($request->all());

        // Validate the form data
        //$request->validate([
        //    'title' => 'required|string|max:255',
        //    'description' => 'required|string',
        //]);

        // Create a new task with default status 'bejegyezve'
        $task = Task::create([
            'title' => $request->input('title'),
            'description' => $request->input('description'),
            'status' => 'bejegyezve',
            'start_date' => now(),
            'end_date' => $request->input('end_date') ?? null,
            'user_id' => null,
        ]);
        if (!$task) {
            Log::error('Task creation failed', ['request' => $request->all()]);
        }

        return redirect()->route('tasks.index')->with('success', 'Task created successfully.');
        //return redirect()->back()->with('success', 'Task created successfully.');
        //return response()->json(['message' => 'Task created successfully']);
        //return redirect()->route('tasks.create')->with('success', 'Task created successfully.');
    }
    public function index()
    {
        $tasks = Task::all(); // Retrieve all tasks from the database
        $tasks = Task::with('user')->get();
        return view('index', ['tasks' => $tasks]);
    }
    public function acceptTask(Request $request, Task $task)
    {
        // Attach the authenticated user to the task and record the acceptance time
        auth()->user()->tasks()->attach($task, ['accepted_at' => now()]);

        // Update the task status and updated_at in the tasks table
        $task->update([
            'status' => 'folyamatban',
            'updated_at' => now(),
        ]);

        return redirect()->route('tasks.index')->with('success', 'Task accepted successfully.');
    }
    public function finishTask(Request $request, Task $task)
    {
        // Detach the authenticated user from the task and record the completion time
        auth()->user()->tasks()->updateExistingPivot($task, ['finished_at' => now()]);

        // Update the task status and updated_at in the tasks table
        $task->update([
            'status' => 'befejezve',
            'updated_at' => now(),
        ]);

        return redirect()->route('tasks.index')->with('success', 'Task marked as finished successfully.');
    }
}


