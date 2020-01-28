<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
            'currentUrl' => $request->fullUrlWithQuery($currentQuery),
            'apiToken' => Auth::user()->api_token ?? ''
        ]);
    }

    public function create(Request $request)
    {
        $validatedData = $request->validate(
            [
                'search' => 'required|min:3'
            ],
            [
                'search.required' => 'Querés buscar algo?'
            ]
        );
        $query = filter_var($validatedData['search'], FILTER_SANITIZE_STRING);
        return redirect()->route('view_search', ['q' => urlencode($query)]);
    }
}
