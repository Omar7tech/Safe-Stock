@extends('user.layout.app')
@section('style')
<style>
    .mycard {
        transition: transform 0.23s, background-color 0.3s, color 0.3s, box-shadow 0.3s;
        border: 1px solid transparent; /* Initial border */
    }

    [data-bs-theme="light"] .mycard{
        box-shadow: 0 0 10px 2px #dbdbdb;
    }
    [data-bs-theme="dark"] .mycard{
        box-shadow: 0 0 10px 2px #000000;
    }
    .mycard:hover {
        transform: scale(1.035);
        box-shadow: 0 0 10px 2px #007bff; /* Blue shadow effect */
    }

    .mycard-title {
        transition: color 0.2s;
    }

    .mycard:hover .card-title {
        color: #007bff;
        /* Blue text color on hover */
    }

    .mycard-footer {
        transition: background-color 0.3s;
    }

    .card-text,
    .text-body-secondary {
        transition: color 0.3s;
    }

    [data-bs-theme="dark"] .card-text,
    [data-bs-theme="dark"] .text-body-secondary {
        color: #b0b0b0;
        /* Light gray text for better readability in dark mode */
    }
</style>

@endsection

@section('content')
    <div class="card mt-4">
        <div class="card-header d-flex justify-content-between align-items-center">
            <div class="d-inline">
                @component('components.userbreadcrumbs')
                    @slot('items', [['name' => 'Home', 'url' => '/'], ['name' => 'Categories', 'url' => '/categories'], ['name' => 'All', 'url' => '']])
                @endcomponent
            </div>
            <div class="d-inline">
                {{ $categories->links('vendor.pagination.simple-bootstrap-4') }}
            </div>
        </div>

        <div class="card-body">
            <div>
                <div class="d-inline">
                    <form class="d-flex" action="{{ route('categories.index') }}" method="GET">
                        <input class="form-control me-2" type="search" name="search" placeholder="Search categories"
                               value="{{ $search ?? '' }}">
                        <div class="btn-group" role="group">
                            <button class="btn btn-outline-primary" type="submit">Search</button>
                            <a href="{{ route('categories.index') }}" class="btn btn-outline-danger">Reset</a>
                        </div>
                    </form>
                </div>
            </div>
            <hr>
            @if($categories->isEmpty())
                <p class="text-center">No categories found.</p>
            @else
                <div class="row row-cols-1 row-cols-md-3 g-4">
                    @foreach ($categories as $index => $category)
                        @php
                            $count = $category->products->count();
                        @endphp
                        <div class="col">
                            <div class="card h-100 mycard">
                                <div class="card-body">
                                    <h4 class="card-title">{{ $category->name }}
                                        <a @if ($count) href="sdf" @endif type="button"
                                            class="btn btn-primary position-relative float-end @if (!$count) disabled @endif">
                                            <i class="bi bi-boxes"></i>
                                            <span
                                                class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                                {{ $count }}
                                                <span class="visually-hidden">products in this category</span>
                                            </span>
                                        </a>
                                        @if ($index === 0)
                                            <i class="bi bi-star-fill text-warning"></i>
                                        @endif
                                    </h4>
                                    <p class="card-text">{{ $category->description }}</p>
                                </div>
                                <div class="card-footer">
                                    <small class="text-body-secondary">Last updated {{ $category->updated_at }}</small>
                                    <div class="btn-group float-end" role="group" aria-label="Basic outlined example">
                                        <a type="button" href="{{ route('categories.edit', Hashids::encode($category->id)) }}"
                                            class="btn btn-outline-secondary btn-sm"><i class="bi bi-pencil"></i></a>

                                        @if (!$count)
                                            <form action="{{ route('categories.destroy', Hashids::encode($category->id)) }}"
                                                method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-outline-danger btn-sm"
                                                    onclick="return confirm('Are you sure you want to delete this category?');">
                                                    <i class="bi bi-trash"></i>
                                                </button>
                                            </form>
                                        @endif

                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
@endsection
