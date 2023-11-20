<!-- resources/views/admin_users_index.blade.php -->
<style>
    ul {
        list-style-type: none;
        padding: 0;
    }

    li {
        background-color: #f8f9fa;
        margin-bottom: 20px;
        padding: 15px;
        border-radius: 8px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        transition: background-color 0.3s ease-in-out;
    }

    li:hover {
        background-color: #e9ecef;
    }

    h3 {
        margin-bottom: 10px;
        color: #007bff;
        font-size: 1.5rem;
    }

    .user-tasks {
        padding-left: 20px;
    }

    .task-item {
        background-color: #d4edda;
        margin-bottom: 10px;
        padding: 8px;
        border-radius: 4px;
    }
</style>

@extends('layouts.app')

@section('content')

<h2>Admin Users and Their Tasks</h2>

@forelse($users as $user)
    <h3>{{ $user->name }}</h3>
    <ul>
        @forelse($user->acceptedTasks as $task)
            <li>{{ $task->title }} - {{ $task->description }}</li>
        @empty
            <li>No tasks in progress.</li>
        @endforelse
    </ul>
@empty
    <p>No users found.</p>
@endforelse

@endsection
