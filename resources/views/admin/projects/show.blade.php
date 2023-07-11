@extends('admin.layouts.base')

@section('contents')
    <h1>{{ $project->title }}</h1>
    <span>Created: {{ $project->creation_date }}</span>
    <span>Updated: {{ $project->last_update }}</span>
    <h2>Category: {{ $project->category->name }}</h2>
    <p>{{ $project->category->description }}</p>
@endsection