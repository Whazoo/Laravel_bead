<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;

class SearchController extends Controller
{

    public function search(Request $request)
    {
        $request->validate([
            'title' => 'nullable|string',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date',
            'status' => 'nullable|in:bejegyezve,folyamatban,befejezve,lezarva',
        ]);

        $results = Task::query()
            ->when($request->filled('title'), function ($query) use ($request) {
                return $query->where('title', 'like', '%' . $request->input('title') . '%');
            })
            ->when($request->filled('start_date'), function ($query) use ($request) {
                return $query->where('start_date', '>=', $request->input('start_date'));
            })
            ->when($request->filled('end_date'), function ($query) use ($request) {
                return $query->where('end_date', '<=', $request->input('end_date'));
            })
            ->when($request->filled('status'), function ($query) use ($request) {
                return $query->where('status', $request->input('status'));
            })
            ->get();

        $status = ['bejegyezve', 'folyamatban', 'befejezve', 'lezarva'];

        return view('search', compact('results', 'status'));
    }


}


