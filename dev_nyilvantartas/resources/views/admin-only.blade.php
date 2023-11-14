<!-- resources/views/admin-only-page.blade.php -->
@extends('layouts.app')


@section('content')
@admin
@if(auth()->check() && auth()->user()->status === 'admin')
    <div>
        <p>
            This content is only visible to admins.
        </p>
    </div>
@endif
@endadmin

@endsection

