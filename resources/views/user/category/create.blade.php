@extends('user.layout.app')

@section('content')
<div class="card mt-4">
    <div class="card-header">
        <div class="d-inline">
            @component('components.userbreadcrumbs')
                @slot('items', [['name' => 'Home', 'url' => '/'], ['name' => 'Categories', 'url' => '/categories'], ['name' => 'Create', 'url' => '']])
            @endcomponent
        </div>
        <h3>Create New Category</h3>
    </div>
    <div class="card-body">
        <form action="{{ route('categories.store') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label for="name" class="form-label">Category Name</label>
                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}" required>
                @error('name')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description">{{ old('description') }}</textarea>
                @error('description')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary">Create Category</button>
        </form>
    </div>
</div>
@endsection
