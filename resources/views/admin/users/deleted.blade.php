@extends('admin.layout.app')

@section('content')

    @component('components.breadcrumbs')
        @slot('items', [['name' => 'Home', 'url' => '/'], ['name' => 'Users', 'url' => '/users'], ['name' => 'Deleted', 'url' => '']])
    @endcomponent
    <div class="row align-items-center">
        <div class="col">
            {{ $users->links('vendor.pagination.bootstrap-4') }}
        </div>
        <div class="col-auto" id="btn-setting">
            <button class="btn btn-dark mb-3"><i class="bi bi-funnel-fill"></i></button>
        </div>
    </div>

    <div class="card mb-4 d-none" id="settings">
        <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Filter Deleted Users</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('users.deleted') }}" method="GET">
                <div class="row g-3">
                    <div class="col-md-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" id="name" name="name" class="form-control" placeholder="Enter name" value="{{ request('name') }}">
                    </div>
                    <div class="col-md-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="text" id="email" name="email" class="form-control" placeholder="Enter email" value="{{ request('email') }}">
                    </div>
                    <div class="col-md-3">
                        <label for="mobile" class="form-label">Mobile</label>
                        <input type="text" id="mobile" name="mobile" class="form-control" placeholder="Enter mobile" value="{{ request('mobile') }}">
                    </div>
                    <div class="col-md-3">
                        <label for="joined_at" class="form-label">Joined Date</label>
                        <input type="date" id="joined_at" name="joined_at" class="form-control" value="{{ request('joined_at') }}">
                    </div>
                    <div class="col-12 d-flex justify-content-end mt-3">
                        <button type="submit" class="btn btn-primary me-2">Apply Filters</button>
                        <a class="btn btn-danger" href="{{ route('users.index') }}">Reset</a>
                    </div>
                </div>
            </form>
        </div>
    </div>

    @if (!$users->isEmpty())
        <div class="table-responsive">
            <table class="table table-striped table-hover">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col"></th>
                        <th scope="col">Name</th>
                        <th scope="col">Email</th>
                        <th scope="col">Mobile</th>
                        <th scope="col">Joined At</th>
                        <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                        <tr id="user-{{ $user->id }}">
                            <td class="align-middle">{!! Avatar::create($user->name)->setFontFamily('Laravolt')->toSvg() !!}</td>
                            <td class="align-middle">{{ $user->name }}</td>
                            <td class="align-middle">{{ $user->email }}</td>
                            <td class="align-middle">{{ $user->mobile }}</td>
                            <td class="align-middle">{{  \Carbon\Carbon::parse($user->created_at)->format('d-m-Y')  }}</td>
                            <td class="align-middle">
                                <div class="d-flex justify-content-around">
                                    <button class="btn btn-success btn-sm restore-btn" data-id="{{ $user->id }}">
                                        <i class="bi bi-arrow-clockwise"></i> Restore
                                    </button>
                                    <button class="btn btn-danger btn-sm destroy-btn" data-id="{{ $user->id }}">
                                        <i class="bi bi-trash"></i> Destroy
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

        </div>
        {{ $users->links('vendor.pagination.bootstrap-5') }}
    @else
    <div class="container mt-5 text-center">
        <h1 class="display-4">No Users Found</h1>
        <p class="lead">We couldn't find any users matching your criteria.</p>
        <a href="javascript:history.back()" class="btn btn-primary mt-3">
            <i class="bi bi-arrow-left-circle"></i> Go Back
        </a>
    </div>

    @endif

    <!-- Restore Confirmation Modal -->
    <div class="modal fade" id="restoreModal" tabindex="-1" aria-labelledby="restoreModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="restoreModalLabel">Restore User</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Are you sure you want to restore this user?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-success" id="confirmRestore">Restore</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Destroy Confirmation Modal -->
    <div class="modal fade" id="destroyModal" tabindex="-1" aria-labelledby="destroyModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="destroyModalLabel">Delete User</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Are you sure you want to permanently delete this user?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-danger" id="confirmDestroy">Delete</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"></script>

    <script>
        $(document).ready(function() {
            let userId;

            $("#btn-setting").click(function() {
                $("#settings").toggleClass("d-none");
            });

            $('.restore-btn').click(function() {
                userId = $(this).data('id');
                $('#restoreModal').modal('show');
            });

            $('#confirmRestore').click(function() {
                $.ajax({
                    url: '/users/restore/' + userId,
                    type: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        $('#user-' + userId).remove();
                        $('#restoreModal').modal('hide');
                    },
                    error: function(response) {
                        alert('Error restoring user.');
                        $('#restoreModal').modal('hide');
                    }
                });
            });

            $('.destroy-btn').click(function() {
                userId = $(this).data('id');
                $('#destroyModal').modal('show');
            });

            $('#confirmDestroy').click(function() {
                $.ajax({
                    url: '/users/destroy/' + userId,
                    type: 'DELETE',
                    data: {
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        $('#user-' + userId).remove();
                        $('#destroyModal').modal('hide');
                    },
                    error: function(response) {
                        alert('Error deleting user.');
                        $('#destroyModal').modal('hide');
                    }
                });
            });
        });
    </script>

@endsection
