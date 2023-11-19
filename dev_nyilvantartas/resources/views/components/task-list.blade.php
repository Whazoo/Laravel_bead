<!-- resources/views/components/task-list.blade.php -->

@props(['tasks','isAdmin'])

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
        max-width: 800px;
        margin-left: 300px;
        margin-top: 20px;
        display: flex;
        justify-content: space-between;
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
    .button-62 {
    background: linear-gradient(to bottom right, #EF4765, #FF9A5A);
    border: 0;
    border-radius: 12px;
    color: #FFFFFF;
    cursor: pointer;
    display: inline-block;
    font-family: -apple-system,system-ui,"Segoe UI",Roboto,Helvetica,Arial,sans-serif;
    font-size: 16px;
    font-weight: 500;
    line-height: 2.5;
    outline: transparent;
    padding: 0 1rem;
    text-align: center;
    text-decoration: none;
    transition: box-shadow .2s ease-in-out;
    user-select: none;
    -webkit-user-select: none;
    touch-action: manipulation;
    white-space: nowrap;
    }

    .button-62:not([disabled]):focus {
    box-shadow: 0 0 .25rem rgba(0, 0, 0, 0.5), -.125rem -.125rem 1rem rgba(239, 71, 101, 0.5), .125rem .125rem 1rem rgba(255, 154, 90, 0.5);
    }

    .button-62:not([disabled]):hover {
    box-shadow: 0 0 .25rem rgba(0, 0, 0, 0.5), -.125rem -.125rem 1rem rgba(239, 71, 101, 0.5), .125rem .125rem 1rem rgba(255, 154, 90, 0.5);
    }
    .bejegyezve {
        background-color: #ffc107;
    }

    .folyamatban {
        background-color: #17a2b8;
    }

    .befejezve {
        background-color: #28a745;
    }

    .lezarva {
        background-color: #6c757d;
    }
</style>

<ul>
    @forelse($tasks as $task)
        <li class="{{ strtolower($task->status) }}">
            {{ $task->title }} - {{ $task->description }}

            @if ($isAdmin)
                @if ($task->status === 'bejegyezve')
                    <!-- Admin actions -->
                    <form method="POST" action="{{ route('tasks.delete', $task) }}">
                        @csrf
                        @method('DELETE')
                        <button class="button-62" type="submit">Törlés</button>
                    </form>
                @elseif ($task->status === 'befejezve')
                    <form method="POST" action="{{ route('tasks.close', $task) }}">
                        @csrf
                        <button  class="button-62" type="submit">Lezárás</button>
                    </form>
                @endif
            @else
                {{-- User actions --}}
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
            @endif
        </li>
    @empty
        <li>No tasks available.</li>
    @endforelse
</ul>


