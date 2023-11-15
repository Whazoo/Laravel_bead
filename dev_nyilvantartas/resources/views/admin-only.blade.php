<!-- resources/views/admin-only-page.blade.php -->
@extends('layouts.app')

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Feladatok létrehozása:') }}
        </h2>
    </x-slot>

    <x-task-form></x-task-form>

</x-app-layout>


