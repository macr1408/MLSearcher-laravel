@extends('layouts.app')

@section('content')

<search-results search-term="{{ $searchTerm }}"></search-results>

@endsection