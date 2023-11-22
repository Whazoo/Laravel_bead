<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        $request->validate([
            'title' => 'string',
            'start_date' => 'date',
            'end_date' => 'date',
        ]);

        $results = Task::where('title', 'like', '%'. $request->input('title'). '%')
        ->when($request->input('start_date'), function ($query) use ($request) {
            return $query->where('start_date', '>=', $request->input('start_date'));
        })
        ->when($request->input('end_date'), function ($query) use ($request) {
            return $query->where('end_date', '<=', $request->input('end_date'));
        })
        ->get();

        return view('search', compact('results'));
    }
}


