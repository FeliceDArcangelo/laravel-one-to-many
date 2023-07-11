@extends('admin.layouts.base')

@section('contents')
    <h1>{{ $category->name }}</h1>
    <p>{{ $category->description }}</p>

    <h2>prjects in this category</h2>
    <ul>
        @foreach ($category->projects as $project)
        <li><a href="{{ route('admin.project.show', ['project' => $project]) }}">{{ $project->title }}</a></li>
    @endforeach
        
    </ul>
    
@endsection