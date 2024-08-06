@extends('user.layout.app')

@section('content')
<div class="container mt-4">
    @component('components.userbreadcrumbs')
                    @slot('items', [['name' => 'Home', 'url' => '/'], ['name' => 'Suppliers', 'url' => '/supplier'], ['name' =>
                        'Create', 'url' => '']])
                    @endcomponent
    <div class="card">
        <div class="card-header">
            <h3 class="text-center">Add New Supplier <i class="bi bi-boxes"></i></h3>
        </div>
        <div class="card-body">
            <form action="{{ route('supplier.store') }}" method="POST">
                @csrf

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="name">Name</label>
                        <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}">
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="email">Email</label>
                        <input type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}">
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="address">Address</label>
                        <input type="text" name="address" id="address" class="form-control @error('address') is-invalid @enderror" value="{{ old('address') }}">
                        @error('address')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="phone">Phone</label>
                        <input type="text" name="phone" id="phone" class="form-control @error('phone') is-invalid @enderror" value="{{ old('phone') }}">
                        @error('phone')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="city">City</label>
                        <input type="text" name="city" id="city" class="form-control @error('city') is-invalid @enderror" value="{{ old('city') }}">
                        @error('city')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="state">State</label>
                        <input type="text" name="state" id="state" class="form-control @error('state') is-invalid @enderror" value="{{ old('state') }}">
                        @error('state')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="country">Country</label>
                        <input type="text" name="country" id="country" class="form-control @error('country') is-invalid @enderror" value="{{ old('country') }}">
                        @error('country')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="postal_code">Postal Code</label>
                        <input type="text" name="postal_code" id="postal_code" class="form-control @error('postal_code') is-invalid @enderror" value="{{ old('postal_code') }}">
                        @error('postal_code')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="contact_person">Contact Person</label>
                        <input type="text" name="contact_person" id="contact_person" class="form-control @error('contact_person') is-invalid @enderror" value="{{ old('contact_person') }}">
                        @error('contact_person')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="website">Website</label>
                        <input type="text" name="website" id="website" class="form-control @error('website') is-invalid @enderror" value="{{ old('website') }}">
                        @error('website')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="tax_id">Tax ID</label>
                        <input type="text" name="tax_id" id="tax_id" class="form-control @error('tax_id') is-invalid @enderror" value="{{ old('tax_id') }}">
                        @error('tax_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="bank_account">Bank Account</label>
                        <input type="text" name="bank_account" id="bank_account" class="form-control @error('bank_account') is-invalid @enderror" value="{{ old('bank_account') }}">
                        @error('bank_account')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="form-group mb-3">
                    <label for="notes">Notes</label>
                    <textarea name="notes" id="notes" class="form-control @error('notes') is-invalid @enderror">{{ old('notes') }}</textarea>
                    @error('notes')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit" class="btn btn-primary">Add Supplier</button>
            </form>
        </div>
    </div>
</div>
@endsection
