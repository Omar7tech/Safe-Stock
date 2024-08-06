@extends('admin.layout.app')

@section('content')

    @component('components.breadcrumbs')
        @slot('items', [['name' => 'Home', 'url' => '/'], ['name' => 'Users', 'url' => '/users'], ['name' => 'All', 'url' =>
            '']])
        @endcomponent

        <div class="row align-items-center">
            <div class="col">
                {{ $users->links('vendor.pagination.bootstrap-4') }}
            </div>
            <div class="col-auto" id="btn-setting">
                <button class="btn btn-dark mb-3"><i class="bi bi-funnel-fill"></i></button>
            </div>
        </div>

        <div class="card mb-2 d-none" id="settings">
            <div class="card-body">
                <form action="{{ route('users.index') }}" method="GET">
                    <div class="row g-3 align-items-center">
                        <div class="col-md-3">
                            <label for="name" class="form-label">Filter by Name</label>
                            <input type="text" id="name" name="name" class="form-control"
                                value="{{ request('name') }}">
                        </div>
                        <div class="col-md-3">
                            <label for="email" class="form-label">Filter by Email</label>
                            <input type="text" id="email" name="email" class="form-control"
                                value="{{ request('email') }}">
                        </div>
                        <div class="col-md-3">
                            <label for="mobile" class="form-label">Filter by Mobile</label>
                            <input type="text" id="mobile" name="mobile" class="form-control"
                                value="{{ request('mobile') }}">
                        </div>
                        <div class="col-md-3">
                            <label for="joined_at" class="form-label">Filter by Joined Date</label>
                            <input type="date" id="joined_at" name="joined_at" class="form-control"
                                value="{{ request('joined_at') }}">
                        </div>
                        <div class="col-auto">
                            <button type="submit" class="btn btn-primary">Apply Filters</button>
                            <a type="button" class="btn btn-danger" href="{{ route('users.index') }}">Reset</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        @if (!$users->isEmpty())
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <th></th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Mobile</th>
                        <th>Joined At</th>
                        <th style="background: rgb(0, 0, 0)">Actions</th>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                            <tr>
                                <td>
                                    {!! Avatar::create($user->name)->setFontFamily('Laravolt')->toSvg() !!}
                                </td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->mobile }}</td>
                                <td>{{ $user->created_at }}</td>
                                <td style="background: rgb(0, 0, 0)">
                                    <div class="btn-group btn-group-sm" role="group" aria-label="Small button group">
                                        <a type="button" class="btn btn-dark"
                                            href="{{ route('users.edit', ['user' => Hashids::encode($user->id)]) }}"><i
                                                class="bi bi-pencil-square"></i></a>
                                        <a type="button" class="btn btn-dark"
                                            href="{{ route('users.show', ['user' => Hashids::encode($user->id)]) }}"><i
                                                class="bi bi-eye"></i></a>
                                    </div>

                                    <div class="btn-group btn-group-sm" role="group" aria-label="Small button group">
                                        <a class="btn"
                                            href="{{ route('users.status', ['n' => $user->email, 'rg1' => 'email', 'rg2' => 'all']) }}">
                                            @if ($user->active == 'active')
                                                <i class="bi bi-wifi text-success"></i>
                                            @else
                                                <i class="bi bi-wifi-off text-danger"></i>
                                            @endif
                                        </a>
                                        <a class="btn favorite-btn" href="#" data-user-id="{{ $user->id }}"
                                            data-url="{{ route('users.favorite', ['user' => $user->id]) }}"
                                            data-favorited="{{ $user->favorites->contains('admin_id', auth()->id()) }}">
                                            @if ($user->favorites->contains('admin_id', auth()->id()))
                                                <i class="bi bi-star-fill text-warning"></i>
                                            @else
                                                <i class="bi bi-star text-secondary"></i>
                                            @endif
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            {{ $users->links('vendor.pagination.bootstrap-5') }}
            <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
            <script>
                $(document).ready(function() {
                    $(".favorite-btn").click(function(e) {
                        e.preventDefault();
                        var btn = $(this); // Capture the button element

                        var userId = btn.data('user-id');
                        var url = btn.data('url');
                        var isFavorited = btn.data('favorited');

                        $.ajax({
                            url: url,
                            method: 'POST',
                            data: {
                                _token: '{{ csrf_token() }}',
                                user_id: userId,
                                favorited: !isFavorited
                            },
                            success: function(response) {
                                if (response.status === 'success') {
                                    if (response.favorited) {
                                        // Update UI to show favorited state
                                        btn.html('<i class="bi bi-star-fill text-warning"></i>');
                                    } else {
                                        // Update UI to show non-favorited state
                                        btn.html('<i class="bi bi-star text-secondary"></i>');
                                    }
                                    btn.data('favorited', response.favorited); // Update data attribute
                                } else {
                                    console.error('Failed to update favorite status');
                                }
                            },
                            error: function(xhr, status, error) {
                                console.error('AJAX Error: ' + status + ' - ' + error);
                            }
                        });
                    });

                    $("#btn-setting").click(function() {
                        $("#settings").toggleClass("d-none");
                    });
                });
            </script>
        @else
            <div class="container mt-5">
                <h1>No Users Found</h1>
                <!-- No users found message -->
            </div>
        @endif

    @endsection
