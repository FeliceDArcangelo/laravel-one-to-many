@extends('admin.layouts.base')

@section('contents')
    <h1>Edit project</h1>

    <form method="POST" action="{{ route('admin.project.update', ['project' => $project]) }}">
        @csrf
        @method('put')

        <div class="mb-3">
            <label for="title" class="form-label">Title</label>
            <input
                type="text"
                class="form-control @error('title') is-invalid @enderror"
                id="title"
                name="title"
                value="{{ old('title', $project->title) }}"
            >
            <div class="invalid-feedback">
                @error('title') {{ $message }} @enderror
            </div>
        </div>

        <div class="mb-3">
            <label for="category" class="form-label">Category</label>
            <select class="form-select @error('category_id') is-invalid @enderror"  id="category" name="category_id">
                <option selected>Change Category</option>

                @foreach ($categories as $category)
                    <option 
                        value="{{ $category->id }}"
                        @if (old('category_id', $project->category->id) == $category->id) selected @endif
                    >{{ $category->name }}</option>
                @endforeach
            </select>
            <div class="invalid-feedback">
                @error('category_id') {{ $message }} @enderror
            </div>
        </div>  

        <div class="mb-3">
            <label for="author" class="form-label">Author</label>
            <input
                type="text"
                class="form-control @error('author') is-invalid @enderror"
                id="author"
                name="author"
                value="{{ old('author', $project->author) }}"
            >
            <div class="invalid-feedback">
                @error('author') {{ $message }} @enderror
            </div>
        </div>

        <div class="mb-3">
            <label for="creation_date" class="form-label">Creation date</label>
            <input
                type="date"
                class="form-control @error('creation_date') is-invalid @enderror"
                id="creation_date"
                name="creation_date"
                value="{{ old('creation_date', $project->creation_date) }}"
            >
            <div class="invalid-feedback">
                @error('creation_date') {{ $message }} @enderror
            </div>
        </div>

        <div class="mb-3">
            <label for="last_update" class="form-label">Last update</label>
            <input
                type="date"
                class="form-control @error('last_update') is-invalid @enderror"
                id="last_update"
                name="last_update"
                value="{{ old('last_update', $project->last_update) }}"
            >
            <div class="invalid-feedback">
                @error('last_update') {{ $message }} @enderror
            </div>
        </div>

        <div class="mb-3">
            <label for="collaborators" class="form-label">Collaborators</label>
            <input
                type="text"
                class="form-control @error('collaborators') is-invalid @enderror"
                id="collaborators"
                name="collaborators"
                value="{{ old('collaborators', $project->collaborators) }}"
            >
            <div class="invalid-feedback">
                @error('collaborators') {{ $message }} @enderror
            </div>
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea
                class="form-control @error('description') is-invalid @enderror"
                id="description"
                rows="3"
                name="description">{{ old('description', $project->description) }}</textarea>
            <div class="invalid-feedback">
                @error('description') {{ $message }} @enderror
            </div>
        </div>

        <div class="mb-3">
            <label for="languages" class="form-label">Languages</label>
            <input
                type="text"
                class="form-control @error('languages') is-invalid @enderror"
                id="languages"
                name="languages"
                value="{{ old('languages', $project->languages) }}"
            >
            <div class="invalid-feedback">
                @error('languages') {{ $message }} @enderror
            </div>
        </div>

        <div class="mb-3">
            <label for="link_github" class="form-label">Link github</label>
            <input
                type="text"
                class="form-control @error('link_github') is-invalid @enderror"
                id="link_github"
                name="link_github"
                value="{{ old('link_github', $project->link_github) }}"
            >
            <div class="invalid-feedback">
                @error('link_github') {{ $message }} @enderror
            </div>
        </div>

        <button class="btn btn-primary">Save</button>
        
    </form>
@endsection