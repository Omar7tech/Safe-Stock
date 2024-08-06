@extends('admin.layout.app')

@section('content')
    @component('components.breadcrumbs')
        @slot('items', [['name' => 'Home', 'url' => '/'], ['name' => 'Users', 'url' => '/users'], ['name' => 'Edit', 'url' =>
            '']])
        @endcomponent
        <h1 class="mt-3">Edit User: {{ $user->name }}</h1>
        <hr>
        <form id="editUserForm" class="row g-3">
            @csrf
            @method('PUT')
            <div class="col-md-4">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ $user->name }}">
                <div class="invalid-feedback">
                    Please provide a valid name.
                </div>
            </div>
            <div class="col-md-4">
                <label for="role" class="form-label">Role</label>
                <select class="form-select" id="role" name="role">
                    <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>Admin</option>
                    <option value="user" {{ $user->role == 'user' ? 'selected' : '' }}>User</option>
                </select>
                <div class="invalid-feedback">
                    Please select a valid role.
                </div>
            </div>
            <div class="col-md-4">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" value="{{ $user->email }}">
                <div class="invalid-feedback">
                    Please provide a valid email.
                </div>
            </div>
            <div class="col-md-4">
                <label for="mobile" class="form-label">Mobile</label>
                <input type="text" class="form-control" id="mobile" name="mobile" value="{{ $user->mobile }}">
                <div class="invalid-feedback">
                    Please provide a valid mobile number.
                </div>
            </div>
            <div class="col-12">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </form>


        <script>
            $(document).ready(function() {
                $('#editUserForm').on('submit', function(e) {
                    e.preventDefault();

                    var formData = $(this).serialize();

                    $.ajax({
                        url: '{{ route('users.update', ['user' => Hashids::encode($user->id)]) }}',
                        type: 'POST',
                        data: formData,
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                            'X-HTTP-Method-Override': 'PUT'
                        },
                        success: function(response) {
                            alert('User updated successfully');
                            window.location.href = '{{ route('users.index') }}';
                        },
                        error: function(xhr) {
                            if (xhr.status === 422) {
                                var errors = xhr.responseJSON.errors;
                                for (var field in errors) {
                                    var input = $('[name="' + field + '"]');
                                    input.addClass('is-invalid');
                                    input.next('.invalid-feedback').text(errors[field][0]);
                                }
                            }
                        }
                    });
                });
            });
        </script>
    @endsection
