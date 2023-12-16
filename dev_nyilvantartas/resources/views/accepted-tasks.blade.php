<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Folyamatban lévő feladatok') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">

                    @if(isset($users))
                        <!-- Admin view -->
                        <h3 class="text-xl font-semibold mb-4">Felhasználók és a folyamatban lévő feladataik:</h3>
                        <ul class="list-disc pl-8">
                            @foreach ($users as $user)
                                @if ($user->status === 'user')
                                    <li class="text-lg font-medium text-blue-600">{{ $user->name }}</li>
                                    <ul class="list-disc pl-8">
                                        @foreach($user->acceptedTasks as $task)
                                            <li>{{ $task->title }}</li>
                                        @endforeach
                                    </ul>
                                @endif
                            @endforeach
                        </ul>
                    @elseif(isset($user))
                        <!-- User view -->
                        <h3 class="text-xl font-semibold mb-4">A Te Folyamatban Lévő Feladataid:</h3>
                        <ul class="list-disc pl-8">
                            @foreach($user->acceptedTasks as $task)
                                <li>{{ $task->title }}</li>
                            @endforeach
                        </ul>
                    @else
                        <p class="text-gray-600">No tasks found.</p>
                    @endif

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
