@extends('admin.layouts.base')

@section('contents')

@if (session('delete_success'))
@php
    $project = session('delete_success')
@endphp
<div class="alert alert-danger">
    "{{ $project->title }}" has been moved to the trash!!
    <form action="{{ route("admin.project.cancel", ['project' => $project] )}}" method="post">
        @csrf
        <button class="btn btn-warning">Cancel</button>
    </form>
</div>
@endif

<table class="table table-striped">
    <thead>
        <tr>
            <th scope="col">Title</th>
            <th scope="col">Author</th>
            <th scope="col">Languages</th>
            <th scope="col">Links</th>
            <th scope="col">Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($projects as $project)
            <tr>
                <th scope="row">{{ $project->title }}</th>
                <td>{{ $project->author }}</td>
                <td>{{ $project->languages }}</td>
                <td><a href="{{ $project->link_github }}">Github</a></td>
                <td>
                    <a class="btn btn-primary" href="{{ route('admin.project.show', ['project' => $project]) }}">View</a>
                    <a class="btn btn-warning" href="{{ route('admin.project.edit', ['project' => $project]) }}">Edit</a>
                    {{-- <button type="button" class="btn btn-danger js-delete" data-bs-toggle="modal" data-bs-target="#deleteModal" data-id="{{ $project->id }}">
                        Delete
                    </button> --}}
                    <form action="{{ route('admin.project.destroy', ['project' => $project->id]) }}" method="POST" class="d-inline-block">
                        @csrf
                        @method('delete')
                        <button class="btn btn-danger" href="">Delete</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

{{-- <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="deleteModalLabel">Delete confirmation</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Are you sure?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
                <form
                    action=""
                    data-template= "{{ route('admin.project.destroy', ['project' => '*****']) }}"
                    method="post"
                    class="d-inline-block"
                    id="btn-confirm-delete"
                >
                    @csrf
                    @method('delete')
                    <button class="btn btn-danger">Yes</button>
                </form>
            </div>
        </div>
    </div>
</div> --}}
<a class="btn btn-primary" href="{{ route('admin.project.create') }}">New</a>
{{ $projects->links() }}
@endsection