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
                        <h3>Felhasználók és a folyamatban lévő feladataik:</h3>
                        <ul>
                            @foreach ($users as $user)
                                @if ($user->status === 'user')
                                    <li>{{ $user->name }}</li>
                                    <ul>
                                        @foreach($user->acceptedTasks as $task)
                                            <li>{{ $task->title }}</li>
                                        @endforeach
                                    </ul>
                                @endif
                            @endforeach
                        </ul>
                    @elseif(isset($user))
                        <!-- User view -->
                        <h3>A Te Folyamatban Lévő Feladataid:</h3>
                        <ul>
                            @foreach($user->acceptedTasks as $task)
                                <li>{{ $task->title }}</li>
                            @endforeach
                        </ul>
                    @else
                        <p>No tasks found.</p>
                    @endif

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
