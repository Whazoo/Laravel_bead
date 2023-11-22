<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Keresés a feladatok között:') }}
        </h2>
    </x-slot>

    <x-search-tasks :results="$results" :statuses="$status" />


</x-app-layout>
