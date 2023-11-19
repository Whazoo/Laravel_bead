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
    public function index(Request $request)
    {
        // Retrieve all tasks with user information
        $tasks = Task::with('user')->get();

        // Check for query parameter to filter tasks
        if ($request->has('action')) {
            $action = $request->query('action');

            if ($action === 'deleted') {
                // Filter out deleted tasks
                $tasks = $tasks->reject(function ($task) {
                return $task->trashed();
                });
            } elseif ($action === 'closed') {
                // Filter out closed tasks
                $tasks = $tasks->reject(function ($task) {
                return $task->status === 'lezárva';
                });
            }
        }
        return view('index', ['tasks' => $tasks]);
    }
    public function acceptTask(Request $request, Task $task)
    {
        // Check if the task has already been accepted by any user
        if ($task->user()->whereNotNull('accepted_at')->exists()) {
            return redirect()->route('tasks.index')->with('error', 'Task has already been accepted by another user.');
        }

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
        // Check if the authenticated user has accepted the task
        if (!$task->user()->where('user_id', auth()->id())->whereNotNull('accepted_at')->exists()) {
            return redirect()->route('tasks.index')->with('error', 'You are not authorized to finish this task.');
        }

        // Detach the authenticated user from the task and record the completion time
        auth()->user()->tasks()->updateExistingPivot($task, ['finished_at' => now()]);

        // Check if all users have finished the task
        if ($task->user()->wherePivot('finished_at', null)->doesntExist()) {
            // If all users have finished, update the task status to 'befejezve'
            $task->update([
                'status' => 'befejezve',
                'updated_at' => now(),
            ]);
        }
        return redirect()->route('tasks.index')->with('success', 'Task marked as finished successfully.');
    }
    public function adminTasks()
    {
        $tasks = Task::with('user')->get();
        $isAdmin = auth()->user()->status === 'admin';
        return view('index', ['tasks' => $tasks, 'isAdmin' => $isAdmin]);
    }
    public function deleteTask(Task $task)
    {
        $task->delete();
        return redirect()->route('tasks.index', ['action' => 'deleted'])->with('success', 'Task deleted successfully.');
    }

    public function closeTask(Task $task)
    {
        $task->update(['status' => 'lezárva']);
        return redirect()->route('tasks.index', ['action' => 'closed'])->with('success', 'Task marked as closed successfully.');
    }
}


