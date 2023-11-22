<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class UserController extends Controller
{
    public function showAcceptedTasks()
{
    $user = Auth::user();

    if ($user->isAdmin()) {
        // Admin view: Get all users and their accepted tasks
        $users = User::with('acceptedTasks')->get();
        return view('accepted-tasks', compact('users'));
    } else {
        // User view: Get only the logged-in user's accepted tasks
        $user->load('acceptedTasks');
        return view('accepted-tasks', compact('user'));
    }
}
}
