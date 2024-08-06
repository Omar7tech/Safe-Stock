<!-- resources/views/admin/users/createUser.blade.php -->

@extends('admin.layout.app')

@section('title', 'Create User')

@section('style')
<style>
    .form-container {
        background-color: #1c1c1c;
        border-radius: 8px;
        padding: 20px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
        color: #ffffff;
    }

    .form-container .form-label {
        color: #ffffff;
    }

    .form-container .btn-primary {
        background-color: #ffa500;
        border: none;
    }

    .form-container .btn-primary:hover {
        background-color: #ff8d00;
    }
</style>
@endsection

@section('content')

<div class="container mt-4">
    @component('components.breadcrumbs')
        @slot('items', [['name' => 'Home', 'url' => '/'], ['name' => 'Users', 'url' => '/users'], ['name' => 'Create User', 'url' =>
            '']])
        @endcomponent
    <h2 id="app-name">Create a New User</h2>
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <div class="form-container mt-4">
        <form action="{{ route('admin.store.user') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}" required>
                @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email address</label>
                <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}" required>
                @error('email')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="mobile" class="form-label">Mobile</label>
                <input type="text" class="form-control @error('mobile') is-invalid @enderror" id="mobile" name="mobile" value="{{ old('mobile') }}" required>
                @error('mobile')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" required>
                @error('password')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="password_confirmation" class="form-label">Confirm Password</label>
                <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" required>
            </div>
            <div class="mb-3">
                <label for="role" class="form-label">Role</label>
                <select class="form-select @error('role') is-invalid @enderror" id="role" name="role" required>
                    <option value="user" {{ old('role') == 'user' ? 'selected' : '' }}>User</option>
                    <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                </select>
                @error('role')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="active" class="form-label">Active</label>
                <select class="form-select @error('active') is-invalid @enderror" id="active" name="active" required>
                    <option value="1" {{ old('active') == '1' ? 'selected' : '' }}>Active</option>
                    <option value="0" {{ old('active') == '0' ? 'selected' : '' }}>Inactive</option>
                </select>
                @error('active')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary">Create User</button>
        </form>
    </div>
</div>
@endsection
