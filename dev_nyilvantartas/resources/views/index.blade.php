
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Feladatok listája:') }}
        </h2>
    </x-slot>

    <x-task-list :tasks="$tasks" />

</x-app-layout>
