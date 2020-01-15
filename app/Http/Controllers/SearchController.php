<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function index(Request $request)
    {
        $currentQuery = $request->query();
        $searchFilters = $currentQuery;
        unset($searchFilters['q']);
        return view('search', [
            'searchTerm' => $request->query('q'),
            'searchFilters' => $searchFilters,
            'currentUrl' => $request->fullUrlWithQuery($currentQuery)
        ]);
    }

    public function create(Request $request)
    {
        $validatedData = $request->validate(
            [
                'search' => 'required|min:4'
            ],
            [
                'search.required' => 'Do you want to search anything?'
            ]
        );
        $query = filter_var($validatedData['search'], FILTER_SANITIZE_STRING);
        return redirect()->route('view_search', ['q' => urlencode($query)]);
    }
}
