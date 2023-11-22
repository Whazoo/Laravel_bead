<x-app-layout>
    @if ($results->count() > 0)
    <ul>
        @foreach ($results as $result)
            <li>{{ $result->title }}</li>
            <li>{{ $result->description }}</li>
        @endforeach
    </ul>
@else
    <p>No results found.</p>
@endif
</x-app-layout>
