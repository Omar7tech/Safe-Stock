@extends('admin.layout.app')
@section('style')
    <style>
        /* Hover effect for table rows */
        .table-hover tbody tr:hover {
            background-color: #ffd700 !important;
            /* Gold color */
            cursor: pointer;
        }

        /* Styling for the link */
        .name-link {
            text-decoration: none;
            color: inherit;
        }

        /* Ensuring the text color is not lost when hovered */
        .table-hover tbody tr:hover .name-link {
            color: inherit;
        }

        /* Neon green dot for active status */
        .active-dot {
            height: 10px;
            width: 10px;
            background-color: #39ff14;
            /* Bright neon green */
            border-radius: 50%;
            display: inline-block;
            box-shadow:
                0 0 5px #39ff14,
                0 0 10px #39ff14,
                0 0 20px #39ff14,
                0 0 30px #39ff14,
                0 0 40px #39ff14,
                0 0 50px #39ff14,
                0 0 60px #39ff14;
        }

        /* Neon red dot for inactive status */
        .inactive-dot {
            height: 10px;
            width: 10px;
            background-color: #ff073a;
            /* Bright neon red */
            border-radius: 50%;
            display: inline-block;
            box-shadow:
                0 0 5px #ff073a,
                0 0 10px #ff073a,
                0 0 20px #ff073a,
                0 0 30px #ff073a,
                0 0 40px #ff073a,
                0 0 50px #ff073a,
                0 0 60px #ff073a;
        }
    </style>
@endsection

@section('content')
    @if (!$favorites->isEmpty())
        <div class="card mb-3 mt-3">
            <h5 class="card-header">{{ Auth()->user()->name }} Starred Users</h5>
            <div class="card-body">
                <h3 class="m-0 d-inline">
                    <span class="badge text-bg-secondary">Count : <span id="total-count">{{ $totalCount }}</span></span>
                </h3>
                <h3 class="m-0 d-inline">
                    <span class="badge text-bg-success">Active Users : <span
                            id="active-users-count">{{ $activeUsersCount }}</span></span>
                </h3>
                <h3 class="m-0 d-inline">
                    <span class="badge text-bg-danger">Inactive Users : <span id="inactive-users-count"></span></span>
                </h3>
            </div>
        </div>
        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th></th>
                    <th class="text-warning">Name</th>
                    <th class="text-warning">Email</th>
                    <th class="text-warning">Phone</th>
                    <th class="text-warning">Active</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($favorites as $f)
                    <tr data-href="{{ route('users.index', ['email' => $f->user->email]) }}">
                        <td>
                            {!! Avatar::create($f->user->name)->setBackground('#d9a011')->setForeground('#000000')->setBorder(3, '#000000')->setFontFamily('Laravolt')->toSvg() !!}
                        </td>
                        <td>
                            <a class="name-link"
                                href="{{ route('users.index', ['email' => $f->user->email]) }}">{{ $f->user->name }}</a>
                        </td>
                        <td>
                            {{ $f->user->email }}
                        </td>
                        <td>
                            {{ $f->user->mobile }}
                        </td>
                        <td>
                            @if ($f->user->active == 'active')
                                <span class="active-dot"></span>
                            @else
                            <span class="inactive-dot"></span>
                            @endif

                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{ $favorites->links('vendor.pagination.simple-bootstrap-4') }}

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const totalCount = parseInt(document.getElementById('total-count').innerText);
                const activeUsersCount = parseInt(document.getElementById('active-users-count').innerText);
                const inactiveUsersCount = totalCount - activeUsersCount;
                document.getElementById('inactive-users-count').innerText = inactiveUsersCount;

                const rows = document.querySelectorAll('table.table-hover tbody tr');
                rows.forEach(row => {
                    row.addEventListener('click', function() {
                        window.location.href = this.dataset.href;
                    });
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
