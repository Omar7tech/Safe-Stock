@extends('user.layout.app')

@section('content')
    <div class="card mt-4">
        <div class="card-header d-flex justify-content-between align-items-center">
            <div>
                @component('components.userbreadcrumbs')
                    @slot('items', [['name' => 'Home', 'url' => '/'], ['name' => 'Categories', 'url' => '/categories'], ['name' => 'Edit', 'url' => '']])
                @endcomponent
            </div>
        </div>

        <div class="card-body">
            <h2>Edit Category</h2>
            <form action="{{ route('categories.update', Hashids::encode($category->id)) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="name" class="form-label">Category Name</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name', $category->name) }}" required>
                    @error('name')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="description" class="form-label">Description</label>
                    <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" rows="3">{{ old('description', $category->description) }}</textarea>
                    @error('description')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <button type="submit" class="btn btn-primary">Update Category</button>
            </form>
        </div>
    </div>
@endsection
