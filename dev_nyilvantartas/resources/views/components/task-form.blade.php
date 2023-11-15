<div class="container mx-auto py-6">
    <div class="flex justify-center">
        <div class="w-full max-w-md">
            <div class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
                <h2 class="text-2xl font-bold mb-4">Create Task</h2>
                <form method="post" action="{{ route('tasks.store') }}">
                    @csrf
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="title">Title:</label>
                    <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" type="text" name="title" required>

                    <label class="block text-gray-700 text-sm font-bold mb-2" for="description">Description:</label>
                    <textarea class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id= "description" name="description" required></textarea>
                    <div class="flex items-center justify-between">
                        <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit">
                            Create Task
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
</div>
