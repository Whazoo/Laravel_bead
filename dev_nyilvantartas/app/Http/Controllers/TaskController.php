<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function store(Request $request)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'title' => 'required',
            'description' => 'required',
        ]);

        // Create a new task instance
        $task = new Task();
        $task->title = $validatedData['title'];
        $task->description = $validatedData['description'];
        $task->status = 'bejegyezve'; // Set the default status

        // Save the task to the database
        $task->save();

        // Redirect or return a response as needed
        return redirect()->back()->with('success', 'Task created successfully!');
    }

    public function update(Request $request, Task $task)
    {
        // Update the task with the user's ID, start date, and change the status
        $task->user_id = $request->user()->id;
        $task->start_date = now();
        $task->status = 'folyamatban';

        // Save the updated task to the database
        $task->save();

        // Redirect or return a response as needed
        return redirect()->back()->with('success', 'Task updated successfully!');
    }
}

