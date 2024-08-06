@extends('user.layout.app')

@section('style')
    <style>
        .deleted-card {
            transition: transform 0.3s, background-color 0.3s, color 0.3s;
            background-color: #f8d7da; /* Light red background for deleted items */
            color: #721c24; /* Dark red text color */
        }

        .deleted-card:hover {
            transform: scale(1.045);
            background-color: #f1b0b7; /* Slightly darker red on hover */
        }

        .deleted-card-title {
            color: #721c24;
        }

        .deleted-card-footer {
            background-color: #f5c6cb;
        }

        .deleted-badge {
            background-color: #721c24;
            color: #f8d7da;
        }

        .deleted-badge:hover {
            background-color: #491217;
        }

        .deleted-card-text,
        .deleted-text-body-secondary {
            color: #721c24;
        }
    </style>
@endsection

@section('content')
    <div class="card mt-4">
        <div class="card-header d-flex justify-content-between align-items-center">
            <div class="d-inline">
                @component('components.userbreadcrumbs')
                    @slot('items', [['name' => 'Home', 'url' => '/'], ['name' => 'Categories', 'url' => '/categories'], ['name' => 'Deleted', 'url' => '']])
                @endcomponent
            </div>

            <div class="d-inline">
                {{ $categories->links('vendor.pagination.simple-bootstrap-4') }}
            </div>
        </div>
        <div class="card-body">
            @if($categories->count() > 0)
                <div class="row row-cols-1 row-cols-md-3 g-4">
                    @foreach ($categories as $category)
                        <div class="col">
                            <div class="card h-100 deleted-card">
                                <div class="card-body">
                                    <h4 class="card-title deleted-card-title">{{ $category->name }}
                                        <span class="badge deleted-badge float-end">Deleted</span>
                                    </h4>
                                    <p class="card-text deleted-card-text">{{ $category->description }}</p>
                                </div>
                                <div class="card-footer deleted-card-footer">
                                    <small class="deleted-text-body-secondary">Deleted on {{ $category->deleted_at }}</small>
                                    <div class="btn-group float-end" role="group" aria-label="Basic outlined example">
                                        <form action="{{ route('categories.restore', Hashids::encode($category->id)) }}"
                                              method="POST" class="d-inline">
                                            @csrf
                                            <button type="submit" class="btn btn-outline-success btn-sm">
                                                <i class="bi bi-arrow-clockwise"></i> Restore
                                            </button>
                                        </form>

                                        <form action="{{ route('categories.force-delete', Hashids::encode($category->id)) }}"
                                              method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-outline-danger btn-sm"
                                                    onclick="return confirm('Are you sure you want to permanently delete this category?');">
                                                <i class="bi bi-trash"></i> Delete
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="alert alert-info mt-3">
                    There are no deleted categories at the moment. This page displays categories that have been deleted and are awaiting restoration or permanent deletion.
                </div>
            @endif
        </div>
    </div>
@endsection
