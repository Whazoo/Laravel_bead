<style>
    ul {
        list-style-type: none;
        padding: 0;
    }

    li {
        background-color: #dff0d8; /* Green for positive results */
        margin-bottom: 20px;
        padding: 15px;
        border-radius: 8px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        transition: background-color 0.3s ease-in-out;
    }

    li:hover {
        background-color: #d0e9c6; /* Lighter green on hover */
    }

    p {
        color: #333; /* Dark text color */
    }

    h3 {
        color: #3c763d; /* Dark green for headings */
    }

    p, h3 {
        margin-bottom: 10px;
    }

    p:last-child {
        margin-bottom: 0; /* Remove margin for the last paragraph in each li */
    }

    /* Style for no results */
    .no-results {
        color: #a94442; /* Dark red for no results message */
    }
</style>

<x-app-layout>
    @if ($results->count() > 0)
    <ul>
        @foreach ($results as $result)
            <li>
                <h3>{{ $result->title }}</h3>
                <p>{{ $result->description }}</p>
                <!-- Add more details or styling as needed -->
            </li>
        @endforeach
    </ul>
@else
    <p class="no-results">No results found.</p>
@endif
</x-app-layout>
