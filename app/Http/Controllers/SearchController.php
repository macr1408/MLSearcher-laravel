<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function index(Request $request)
    {
        return view('search', ['searchTerm' => $request->query('q')]);
    }

    public function create(Request $request)
    {
        $validatedData = $request->validate(
            [
                'search' => 'required|min:3'
            ],
            [
                'search.required' => 'Do you want to search anything?'
            ]
        );
        $query = filter_var($validatedData['search'], FILTER_SANITIZE_STRING);
        return redirect()->route('view_search', ['q' => urlencode($query)]);
    }
}
