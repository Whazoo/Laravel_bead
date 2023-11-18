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

    button {
        padding: 8px 12px;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        transition: background-color 0.3s ease-in-out, color 0.3s ease-in-out;
    }

    button[disabled] {
        cursor: not-allowed;
        background-color: #ccc;
        color: #666;
    }

    button.accept-btn {
        background-color: #28a745;
        color: #fff;
        margin-right: 5px; /* Add margin to separate buttons */
    }

    button.finish-btn {
        background-color: #007bff;
        color: #fff;
    }
</style>

<ul>
    @forelse($tasks as $task)
        <li>
            {{ $task->title }} - {{ $task->description }}

            <form method="POST" action="{{ route('tasks.accept', $task) }}">
                @csrf
                <button type="submit" class="accept-btn" @if ($task->status !== 'bejegyezve' || optional($task->users)->contains(auth()->user())) disabled @endif>
                    Elfogadás
                </button>
            </form>

            <form method="POST" action="{{ route('tasks.finish', $task) }}">
                @csrf
                <button type="submit" class="finish-btn" @if ($task->status !== 'folyamatban' || optional(!$task->users)->contains(auth()->user())) disabled @endif>
                    Befejezés
                </button>
            </form>
        </li>
    @empty
        <li>Nincs elérhető feladat.</li>
    @endforelse
</ul>


