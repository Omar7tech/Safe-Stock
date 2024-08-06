<!-- resources/views/user/supplier/show.blade.php -->

@extends('user.layout.app')

@section('content')
    <div class="card mt-4">
        <div class="card-header d-flex justify-content-between align-items-center">
            <div class="d-inline">
                @component('components.userbreadcrumbs')
                    @slot('items', [['name' => 'Home', 'url' => '/'], ['name' => 'Suppliers', 'url' => '/supplier'], ['name' =>
                        $supplier->name, 'url' => '']])
                    @endcomponent

                </div>

                <div class="d-inline">

                    @if ($supplier->notes)
                        <span>
                            <i class="bi bi-stickies-fill text-warning"></i>
                        </span>
                    @endif
                </div>

            </div>
            <div class="card-body">
                <h3>
                    {{ $supplier->name }} <i class="bi bi-box-seam"></i>
                    <div class="float-end d-inline">
                        <a href="{{ route('supplier.edit', Hashids::encode($supplier->id)) }}" class="btn btn-sm btn-secondary"><i
                                class="bi bi-pen-fill"></i></a>
                    </div>
                </h3>
                <hr>
                <div>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">
                            <i class="bi bi-building"></i> <strong>Company Name:</strong> {{ $supplier->name }}
                        </li>
                        <li class="list-group-item">
                            <i class="bi bi-geo-alt"></i> <strong>Address:</strong> {{ $supplier->address }},
                            {{ $supplier->city }}, {{ $supplier->state }}, {{ $supplier->country }},
                            {{ $supplier->postal_code }}
                        </li>
                        <li class="list-group-item">
                            <iframe src="https://www.google.com/maps/search/{{ urlencode($supplier->address . ' ' . $supplier->city . ' ' . $supplier->state . ' ' . $supplier->country . ' ' . $supplier->postal_code) }}" frameborder="0" style="width: 100% ; height:500px; border-radius:10px;" class="border border-primary"></iframe>

                        </li>

                        <li class="list-group-item">
                            <i class="bi bi-telephone"></i> <strong>Phone:</strong> {{ $supplier->phone }}
                        </li>
                        <li class="list-group-item">
                            <i class="bi bi-envelope"></i> <strong>Email:</strong> {{ $supplier->email }}
                        </li>
                        <li class="list-group-item">
                            <i class="bi bi-person"></i> <strong>Contact Person:</strong> {{ $supplier->contact_person }}
                        </li>
                        <li class="list-group-item">
                            <i class="bi bi-globe"></i> <strong>Website:</strong> <a href="{{ $supplier->website }}"
                                target="_blank">{{ $supplier->website }}</a>
                        </li>
                        <li class="list-group-item">
                            <i class="bi bi-credit-card"></i> <strong>Tax ID:</strong> {{ $supplier->tax_id }}
                        </li>
                        <li class="list-group-item">
                            <i class="bi bi-credit-card"></i> <strong>Bank Account:</strong> {{ $supplier->bank_account }}
                        </li>

                        <li class="list-group-item">
                            <i class="bi bi-clock"></i> <strong>Created At:</strong>
                            {{ $supplier->created_at->format('Y-m-d H:i:s') }}
                        </li>
                        <li class="list-group-item">
                            <i class="bi bi-clock"></i> <strong>Last Updated:</strong>
                            {{ $supplier->updated_at->format('Y-m-d H:i:s') }}
                        </li>
                    </ul>
                    @if ($supplier->notes)
                    <hr class="border border-secondary border-3 opacity-75">

                        <div class="card mt-3">
                            <div class="card-body">
                                <h2><i class="bi bi-stickies-fill text-warning"></i> Note:</h2>
                                <hr>
                                {{ $supplier->notes }}
                            </div>
                        </div>
                    @endif

                </div>
            </div>
        </div>
    @endsection
