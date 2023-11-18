<!-- resources/views/components/task-list.blade.php -->

@props(['tasks'])

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
</style>

<ul>
    @forelse($tasks as $task)
        <li>
            {{ $task->title }} - {{ $task->description }}

            @if (!$task->users || !$task->users->contains(auth()->user()))
                <form method="POST" action="{{ route('tasks.accept', $task) }}">
                    @csrf
                    <button type="submit">Elfogadás</button>
                </form>
            @else
                <form method="POST" action="{{ route('tasks.finish', $task) }}">
                    @csrf
                    <button type="submit">Befejezés</button>
                </form>
            @endif
        </li>
    @empty
        <li>Nincs elérhető feladat.</li>
    @endforelse
</ul>
