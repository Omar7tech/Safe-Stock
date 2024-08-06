@extends('user.layout.app')

@section('content')
    <div class="card mt-4">
        <div class="card-header">
            <h4>Edit Supplier</h4>
        </div>
        <div class="card-body">
            <form action="{{ route('supplier.update', Hashids::encode($supplier->id)) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="name" class="form-label"><i class="bi bi-building"></i> Name</label>
                        <input type="text" name="name" class="form-control" id="name"
                            value="{{ $supplier->name }}" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="contact_person" class="form-label"><i class="bi bi-person"></i> Contact Person</label>
                        <input type="text" name="contact_person" class="form-control" id="contact_person"
                            value="{{ $supplier->contact_person }}" required>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12 mb-3">
                        <label for="address" class="form-label"><i class="bi bi-geo-alt"></i> Address         <a href="https://www.google.com/maps/search/{{ urlencode($supplier->address . ' ' . $supplier->city . ' ' . $supplier->state . ' ' . $supplier->country . ' ' . $supplier->postal_code) }}" target="_blank" class="">Show on Map</a>
                        </label>
                        <textarea name="address" class="form-control" id="address" required>{{ $supplier->address }}</textarea>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 mb-3">
                       <iframe src="https://www.google.com/maps/search/{{ urlencode($supplier->address . ' ' . $supplier->city . ' ' . $supplier->state . ' ' . $supplier->country . ' ' . $supplier->postal_code) }}" frameborder="0" style="width: 100% ; height:500px; border-radius:10px;"></iframe>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label for="city" class="form-label"><i class="bi bi-geo-alt"></i> City</label>
                        <input type="text" name="city" class="form-control" id="city"
                            value="{{ $supplier->city }}" required>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="state" class="form-label"><i class="bi bi-geo-alt"></i> State</label>
                        <input type="text" name="state" class="form-control" id="state"
                            value="{{ $supplier->state }}" required>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="country" class="form-label"><i class="bi bi-geo-alt"></i> Country</label>
                        <input type="text" name="country" class="form-control" id="country"
                            value="{{ $supplier->country }}" required>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="postal_code" class="form-label"><i class="bi bi-geo-alt"></i> Postal Code</label>
                        <input type="text" name="postal_code" class="form-control" id="postal_code"
                            value="{{ $supplier->postal_code }}" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="phone" class="form-label"><i class="bi bi-telephone"></i> Phone</label>
                        <input type="text" name="phone" class="form-control" id="phone"
                            value="{{ $supplier->phone }}" required>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="email" class="form-label"><i class="bi bi-envelope"></i> Email</label>
                        <input type="email" name="email" class="form-control" id="email"
                            value="{{ $supplier->email }}" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="website" class="form-label"><i class="bi bi-globe"></i> Website</label>
                        <input type="url" name="website" class="form-control" id="website"
                            value="{{ $supplier->website }}">
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="tax_id" class="form-label"><i class="bi bi-credit-card"></i> Tax ID</label>
                        <input type="text" name="tax_id" class="form-control" id="tax_id"
                            value="{{ $supplier->tax_id }}" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="bank_account" class="form-label"><i class="bi bi-credit-card"></i> Bank Account</label>
                        <input type="text" name="bank_account" class="form-control" id="bank_account"
                            value="{{ $supplier->bank_account }}" required>
                    </div>
                </div>
                <hr class="border border-secondary border-3 opacity-75">
                <div class="mb-3">
                    <label for="notes" class="form-label"><i class="bi bi-stickies-fill text-warning"></i> Notes</label>
                    <textarea name="notes" class="form-control" id="notes">{{ $supplier->notes }}</textarea>
                </div>

                <div class="d-flex justify-content-between">
                    <button type="submit" class="btn btn-primary">Update</button>
                    <a href="{{ route('supplier.index') }}" class="btn btn-secondary">Cancel</a>
                </div>
            </form>
        </div>
    </div>

@endsection
