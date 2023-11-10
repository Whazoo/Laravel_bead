<!-- resources/views/admin-only-page.blade.php -->
@extends('layouts.app')

@section('content')
    @if (auth()->user()->status === 'admin')
        <!-- Content for admin users -->
        <h1>Welcome, Admin!</h1>
        <p>This is the admin-only page.</p>
    @else
        <!-- Content for non-admin users -->
        <x-access-denied />
    @endif
@endsection

