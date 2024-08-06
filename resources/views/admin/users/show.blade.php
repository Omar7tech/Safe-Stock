@extends('admin.layout.app')

@section('content')
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header bg-primary text-white">
                        <h4 class="mb-0">User Details</h4>
                    </div>
                    <div class="card-body">
                        <div class="row mb-3">
                            <div class="col-md-3">
                                <h5>Name:</h5>
                            </div>
                            <div class="col-md-9">
                                <p class="form-control-plaintext">{{ $user->name }}</p>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-3">
                                <h5>Email:</h5>
                            </div>
                            <div class="col-md-9">
                                <p class="form-control-plaintext">{{ $user->email }}</p>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-3">
                                <h5>Mobile:</h5>
                            </div>
                            <div class="col-md-9">
                                <p class="form-control-plaintext">{{ $user->mobile }}</p>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-3">
                                <h5>Role:</h5>
                            </div>
                            <div class="col-md-9">
                                <p class="form-control-plaintext">{{ ucfirst($user->role) }}</p>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-3">
                                <h5>Status:</h5>
                            </div>
                            <div class="col-md-9">
                                <p class="form-control-plaintext">{{ $user->active ? 'Active' : 'Inactive' }}</p>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-3">
                                <h5>Joined At:</h5>
                            </div>
                            <div class="col-md-9">
                                <p class="form-control-plaintext">{{ $user->created_at->format('d-m-Y H:i:s') }}</p>
                            </div>
                        </div>
                        <a href="{{ route('users.index') }}" class="btn btn-secondary mt-3">Back to Users List</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
