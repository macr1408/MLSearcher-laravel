@extends('layouts.app')

@section('content')

<search-results search-term="{{ $searchTerm }}" search-filters="{{ json_encode($searchFilters) }}" api-token="{{ $apiToken }}" current-url="{{ $currentUrl }}">
</search-results>

@endsection