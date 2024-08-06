@extends('user.layout.app')
@section('style')
    <style>
        [data-bs-theme="dark"] .actions-btn {
            background: rgb(63, 63, 63);
        }

        [data-bs-theme="dark"] .actions-btn:hover {
            background: rgb(110, 110, 110);
        }

        [data-bs-theme="light"] .actions-btn {
            background: rgb(201, 201, 201);
        }

        [data-bs-theme="light"] .actions-btn:hover {
            background: rgb(146, 146, 146);
        }

        [data-bs-theme="dark"] th {
            background-color: #1a1a1a;
            /* Dark blue color */
            color: white;
            /* Text color for contrast */
        }

        [data-bs-theme="dark"] .form-control {
            background-color: #2d3436;
            border-color: #6c757d;
            color: #ffffff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
        }

        [data-bs-theme="dark"] .form-control:focus {
            border-color: #17a2b8;
            box-shadow: 0 0 10px rgba(23, 162, 184, 0.7);
        }

        [data-bs-theme="light"] .form-control {
            background-color: #ffffff;
            border-color: #ced4da;
            color: #495057;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        [data-bs-theme="light"] .form-control:focus {
            border-color: #007bff;
            box-shadow: 0 0 10px rgba(0, 123, 255, 0.5);
        }
    </style>
@endsection
@section('content')
    <div class="card mt-4">
        <div class="card-header d-flex justify-content-between align-items-center">
            <div class="d-inline">
                @component('components.userbreadcrumbs')
                    @slot('items', [['name' => 'Home', 'url' => '/'], ['name' => 'Suppliers', 'url' => '/supplier'], ['name' =>
                        'Deleted (' . $suppliers->total() . ')', 'url' => '']])
                    @endcomponent

                </div>

                <div class="d-inline">
                    {{ $suppliers->links('vendor.pagination.simple-bootstrap-4') }}
                </div>
            </div>
            <div class="card-body">
                <!-- Search Form -->
                <form action="{{ route('supplier.deleted') }}" method="GET" class="mb-3">
                    <div class="row">
                        <div class="col-md-3 mb-2">
                            <input type="text" name="name" class="form-control" placeholder="Supplier Name"
                                value="{{ request()->get('name') }}">
                        </div>
                        <div class="col-md-3 mb-2">
                            <input type="text" name="email" class="form-control" placeholder="Email"
                                value="{{ request()->get('email') }}">
                        </div>
                        <div class="col-md-3 mb-2">
                            <input type="text" name="contact_person" class="form-control" placeholder="Contact Person"
                                value="{{ request()->get('contact_person') }}">
                        </div>
                        <div class="col-md-3 mb-2">
                            <button type="submit" class="btn btn-primary"><i class="bi bi-search"></i></button>
                            <a href="{{ route('supplier.index') }}" class="btn btn-secondary"><i
                                    class="bi bi-arrow-clockwise"></i></a>
                        </div>
                    </div>
                </form>

                <!-- Suppliers Table -->
                <div class="table-responsive">
                    <table class="table table-striped table-bordered  border-danger">
                        <thead>
                            <tr>
                                <th></th>
                                <th><i class="bi bi-building"></i> Name</th>
                                <th><i class="bi bi-geo-alt-fill"></i> Address</th>
                                <th><i class="bi bi-envelope-at"></i> Email</th>
                                <th><i class="bi bi-person-lines-fill"></i> Person</th>
                                <th><i class="bi bi-joystick"></i> Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($suppliers as $supplier)
                                <tr>
                                    <td>
                                        {!! Avatar::create($supplier->name)->setTheme('grayscale-dark')->setFontFamily('Laravolt')->toSvg() !!}
                                    </td>
                                    <td><strong>{{ $supplier->name }}</strong></td>
                                    <td>
                                        <small>{{ $supplier->address }}, {{ $supplier->city }}, {{ $supplier->state }},
                                            {{ $supplier->country }}, {{ $supplier->postal_code }}
                                    </td>
                                    <td>{{ $supplier->email }}</small></td>
                                    <td>{{ $supplier->contact_person }}</td>
                                    <td>
                                        <div class="btn-group">
                                            <form action="{{ route('supplier.restore',  Hashids::encode($supplier->id)) }}"
                                                method="POST">
                                                @csrf
                                                <button class="btn btn-sm actions-btn" type="submit"><i
                                                        class="bi bi-arrow-counterclockwise"></i> Restore</button>
                                            </form>
                                            <form action="{{ route('supplier.ForceDelete',  Hashids::encode($supplier->id)) }}"
                                                method="POST">
                                                @csrf
                                                <button class="btn btn-sm actions-btn text-danger" type="submit"><i class="bi bi-exclamation-octagon"></i> Force Delete</button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center">No suppliers found.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                    {{ $suppliers->links('vendor.pagination.bootstrap-5') }}
                </div>
            </div>
        </div>
    @endsection
