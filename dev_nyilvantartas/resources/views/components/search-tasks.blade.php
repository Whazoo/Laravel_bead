
@props(['route,status,result'])

<style>
    .search-container {
        max-width: 400px;
        margin: auto;
        padding: 20px;
        border: 1px solid #ccc;
        border-radius: 8px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    .search-input {
        width: 100%;
        padding: 10px;
        font-size: 16px;
        border: 1px solid #ddd;
        border-radius: 4px;
        box-sizing: border-box;
    }

    .search-button {
        width: 100%;
        padding: 10px;
        margin-top: 10px;
        background-color: #007bff;
        color: #fff;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        font-size: 16px;
    }

    .search-button:hover {
        background-color: #0056b3;
    }

    .search-results {
        margin-top: 20px;
    }

    .search-result-item {
        margin-bottom: 10px;
        padding: 10px;
        border: 1px solid #ddd;
        border-radius: 4px;
        box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
    }
</style>

<div class="search-container">
    <form method="GET" action="{{ route('search') }}">
        @csrf
        <label for="title">Title:</label>
        <input type="text" name="title" class="search-input">

        <label for="start_date">Start Date:</label>
        <input type="date" name="start_date" class="search-input">

        <label for="end_date">End Date:</label>
        <input type="date" name="end_date" class="search-input">

        <label for="status">Status:</label>
        <select id="status" name="status">
            <option value="">All</option>
            <option value="bejegyezve">Bejegyezve</option>
            <option value="folyamatban">Folyamatban</option>
            <option value="befejezve">Befejezve</option>
            <option value="lezárva">Lezárt</option>
        </select>

        <button type="submit" class="search-button">Search</button>
    </form>

</div>

