@extends('admin.layout.app')
@section('style')
    <style>
        .contact-info {
            margin-top: 15px;
            font-size: 1.1em;
        }

        .contact-info a {
            color: #ffc177;
            text-decoration: none;
            -
        }

        .contact-info a:hover {
            text-decoration: underline;
        }
    </style>
@endsection


@section('content')
    @if (!$users->isEmpty())
        @php
            // Determine the status label based on 'rg2' parameter
            $statusLabel = '';
            switch (request()->query('rg2')) {
                case 'active':
                    $statusLabel = 'Active';
                    break;
                case 'inactive':
                    $statusLabel = 'Inactive';
                    break;
                default:
                    $statusLabel = 'All'; // Default label if 'rg2' is not specified or 'all'
                    break;
            }
        @endphp

        @component('components.breadcrumbs')
            @if (request()->query('n'))
                @slot('items', [['name' => 'Home', 'url' => '/'], ['name' => 'Users', 'url' => '/users'], ['name' => 'Status',
                    'url' => route('users.status')]])
                @else
                    @slot('items', [['name' => 'Home', 'url' => '/'], ['name' => 'Users', 'url' => '/users'], ['name' => 'Status',
                        'url' => route('users.status')], ['name' => $statusLabel, 'url' => '#']])
                    @endif
                @endcomponent


                <div class="card mb-2">
                    <div class="card-body row">
                        <div class="col-md-12">
                            <form action="{{ route('users.status') }}" method="get" style="margin: 0" id="searchForm">
                                <div class="input-group">
                                    <button class="btn btn-outline-secondary" type="submit" id="button-addon1">
                                        <i class="bi bi-search"></i>
                                    </button>
                                    <input type="text" class="form-control" placeholder="Search"
                                        aria-label="Example text with button addon" aria-describedby="button-addon1" name="n"
                                        id="searchInput">
                                    <button class="btn btn-warning" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                                        <i class="bi bi-gear-fill"></i>
                                    </button>
                                    <a href="{{ route('users.status') }}" class="btn btn-danger" type="button">
                                        <i class="bi bi-x-square-fill mt-1"></i>
                                    </a>
                                </div>
                                <div class="invalid-feedback">
                                    Search field cannot be empty. Please enter a search term.
                                </div>
                                <div class="collapse mt-2 rounded-lg" id="collapseExample">
                                    <div class="card card-body">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="rg1" id="radio1_1"
                                                value="all" checked>
                                            <label class="form-check-label" for="radio1_1">
                                                All (Name & Email)
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="rg1" id="radio1_2"
                                                value="name">
                                            <label class="form-check-label" for="radio1_2">
                                                Name
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="rg1" id="radio1_3"
                                                value="email">
                                            <label class="form-check-label" for="radio1_3">
                                                Email
                                            </label>
                                        </div>

                                        <hr>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="rg2" id="radio2_1"
                                                value="all" checked>
                                            <label class="form-check-label" for="radio2_1">
                                                All (Active & Inactive)
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="rg2" id="radio2_2"
                                                value="active">
                                            <label class="form-check-label" for="radio2_2">
                                                Active
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="rg2" id="radio2_3"
                                                value="inactive">
                                            <label class="form-check-label" for="radio2_3">
                                                Inactive
                                            </label>
                                        </div>
                                    </div>
                                    <div class="row mt-3">
                                        <div class="col-sm-4 mb-3 d-flex">
                                            <div class="card border  flex-fill">
                                                <a href="{{ route('users.status', ['rg1' => 'all', 'rg2' => 'active']) }}"
                                                    class="btn btn-success">View All Active Users</a>
                                            </div>
                                        </div>
                                        <div class="col-sm-4 mb-3 d-flex">
                                            <div class="card border  flex-fill @if (request('rg2') == 'inactive' && request('rg1') == 'all' && !request('n')) bg-danger @endif">
                                                <a href="{{ route('users.status', ['rg1' => 'all', 'rg2' => 'inactive']) }}"
                                                    class="btn btn-danger">View All In-Active Users</a>
                                            </div>
                                        </div>
                                        <div class="col-sm-4 mb-3 d-flex">
                                            <div class="card border  flex-fill @if (!request('rg2') && !request('rg1') && !request('n')) bg-primary @endif">
                                                <a href="{{ route('users.status') }}" class="btn btn-primary">View All</a>
                                            </div>
                                        </div>
                                    </div>




                                </div>
                            </form>

                        </div>

                    </div>
                </div>
                <div class="table-responsive rounded-sm rounded-3">
                    <table class="table">
                        <thead>
                            <tr>
                                <th></th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                            <tr id="userRow{{ $user->id }}">
                                <td>{!! Avatar::create($user->name)->setFontFamily('Laravolt')->toSvg() !!}</td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>
                                    @if ($user->active === 'active')
                                        <span id="statusBadge{{ $user->id }}" class="badge bg-success">Active</span>
                                        <form action="{{ route('user.Softdelete', ['id' => $user->id]) }}" class="delete-form d-inline m-0 p-0 d-none" data-id="{{ $user->id }}" method="POST" id="deleteForm{{$user->id}}">
                                            @csrf
                                            @method("DELETE")
                                            <button type="submit" class="btn btn-dark"><i class="bi bi-trash3-fill text-danger"></i></button>
                                        </form>
                                    @else
                                        <span id="statusBadge{{ $user->id }}" class="badge bg-danger">Inactive</span>
                                        <form action="{{ route('user.Softdelete', ['id' => $user->id]) }}" class="delete-form d-inline m-0 p-0" data-id="{{ $user->id }}" method="POST" id="deleteForm{{$user->id}}">
                                            @csrf
                                            @method("DELETE")
                                            <button type="submit" class="btn btn-dark"><i class="bi bi-trash3-fill text-danger"></i></button>
                                        </form>
                                    @endif
                                </td>
                                <td>
                                    <span class="form-check form-switch">
                                        <input style="cursor: pointer" class="form-check-input action-checkbox" type="checkbox" role="switch" id="flexSwitchCheckDefault{{ $user->id }}" data-id="{{ $user->id }}" {{ $user->active == 'active' ? 'checked' : '' }}>
                                    </span>
                                </td>
                            </tr>

                            @endforeach
                        </tbody>
                    </table>
                </div>
                {{ $users->links('vendor.pagination.bootstrap-5') }}
                <hr>
                <div class="row">
                    <div class="col-sm-4 mb-3 d-flex">
                        <div class="@if (request('rg2') == 'active' && request('rg1') == 'all' && !request('n')) bg-success @endif card border border-success flex-fill">
                            <div class="card-body">
                                <h5 class="card-title">Active Users: <span id="active-number">{{ $activeUsersCount }}</span></h5>
                                <p class="card-text">This section provides a count of all active users currently registered in the
                                    system.</p>
                                <a href="{{ route('users.status', ['rg1' => 'all', 'rg2' => 'active']) }}"
                                    class="btn btn-success @disabled($activeUsersCount == 0)" id="btn-active">View All Active Users</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4 mb-3 d-flex">
                        <div class="card border border-danger flex-fill @if (request('rg2') == 'inactive' && request('rg1') == 'all' && !request('n')) bg-danger @endif">
                            <div class="card-body">
                                <h5 class="card-title">Inactive Users: <span
                                        id="inactive-number">{{ $inactiveUsersCount }}</span></h5>
                                <p class="card-text">This section provides a count of all inactive users currently registered in
                                    the system.</p>
                                <a href="{{ route('users.status', ['rg1' => 'all', 'rg2' => 'inactive']) }}"
                                    class="btn btn-danger {{ $inactiveUsersCount == 0 ? 'disabled' : '' }}"
                                    id="btn-inactive">View All In-Active Users</a>

                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4 mb-3 d-flex">
                        <div class="card border border-primary flex-fill @if (!request('rg2') && !request('rg1') && !request('n')) bg-primary @endif">
                            <div class="card-body">
                                <h5 class="card-title">Total Users: <span
                                        id="total-number">{{ $inactiveUsersCount + $activeUsersCount }}</span></h5>
                                <p class="card-text">This section displays the total number of users registered in the system,
                                    including both active and inactive users.</p>
                                <a href="{{ route('users.status') }}" class="btn btn-primary  @disabled($inactiveUsersCount + $activeUsersCount == 0)">View
                                    All</a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="toast-container position-fixed bottom-0 end-0 p-3">
                    <div id="statusToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
                        <div class="toast-header">
                            <strong class="me-auto">User Status</strong>
                            <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                        </div>
                        <div class="toast-body">
                            User status updated successfully.
                        </div>
                    </div>
                </div>


                <style>
                    .card-title {
                        font-weight: bold;
                        font-size: 1.25em;
                    }

                    .card-text {
                        margin: 15px 0;
                    }

                    .btn-primary {
                        background-color: #007bff;
                        border-color: #007bff;
                    }

                    .btn-primary:hover {
                        background-color: #0056b3;
                        border-color: #004085;
                    }
                </style>

                <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
                <script>
                    $(document).ready(function() {
                        $('.action-checkbox').change(function() {
                            let userId = $(this).data('id');
                            let status = $(this).is(':checked');
                            let statusBadge = $('#statusBadge' + userId);
                            let deleteForm = $('#deleteForm' + userId);
                            let activeNumber = $('#active-number');
                            let inActiveNumber = $('#inactive-number');
                            $.ajax({
                                url: `/admin/users/${userId}/status`,
                                type: 'PATCH',
                                data: {
                                    _token: '{{ csrf_token() }}',
                                    status: status
                                },
                                success: function(response) {

                                    if (response.success) {
                                        if (status) {
                                            statusBadge.removeClass('bg-danger').addClass('bg-success')
                                                .text('Active');
                                            deleteForm.addClass("d-none");
                                            inActiveNumber.text(parseInt(inActiveNumber.text()) - 1);
                                            activeNumber.text(parseInt(activeNumber.text()) + 1);
                                            if (parseInt(inActiveNumber.text()) === 0) {
                                                $("#btn-inactive").addClass("disabled");
                                            }
                                            if (parseInt(activeNumber.text()) > 0) {
                                                $("#btn-active").removeClass("disabled");
                                            }
                                            var toast = new bootstrap.Toast(document.getElementById(
                                                'statusToast'));
                                            toast.show();
                                        } else {
                                            statusBadge.removeClass('bg-success').addClass('bg-danger')
                                                .text('Inactive');
                                            deleteForm.removeClass("d-none");
                                            $('#delete-form').removeClass("d-none");
                                            inActiveNumber.text(parseInt(inActiveNumber.text()) + 1);
                                            activeNumber.text(parseInt(activeNumber.text()) - 1);
                                            if (parseInt(inActiveNumber.text()) > 0) {
                                                $("#btn-inactive").removeClass("disabled");
                                            }
                                            if (parseInt(activeNumber.text()) === 0) {
                                                $("#btn-active").addClass("disabled");
                                            }
                                            var toast = new bootstrap.Toast(document.getElementById(
                                                'statusToast'));
                                            toast.show();
                                        }
                                    } else {
                                        alert('Failed to update user status.');
                                    }
                                },
                                error: function(xhr) {
                                    alert('Error: ' + xhr.statusText);
                                }
                            });
                        });
                    });
                </script>
                <script>
                    $(document).ready(function() {
                        $('.delete-form').on('submit', function(event) {
                            event.preventDefault(); // Prevent form submission

                            let form = $(this);
                            let userId = form.data('id');

                            $.ajax({
                                url: form.attr('action'),
                                type: 'DELETE',
                                data: form.serialize(),
                                success: function(response) {
                                    if (response.success) {
                                        // Remove the row from the table
                                        $('#userRow' + userId).remove();
                                        let inActiveNumber = $('#inactive-number');
                                        inActiveNumber.text(parseInt(inActiveNumber.text()) - 1);

                                        // Optionally, update counts and button states if necessary
                                        var toast = new bootstrap.Toast(document.getElementById(
                                            'statusToast'));
                                        toast.show();
                                    } else {
                                        alert('Failed to delete user.');
                                    }
                                },
                                error: function(xhr) {
                                    alert('Error: ' + xhr.statusText);
                                }
                            });
                        });
                    });
                </script>


                <script>
                    document.addEventListener('DOMContentLoaded', function() {
                        function getUrlParameter(name) {
                            name = name.replace(/[\[]/, '\\[').replace(/[\]]/, '\\]');
                            var regex = new RegExp('[\\?&]' + name + '=([^&#]*)');
                            var results = regex.exec(location.search);
                            return results === null ? '' : decodeURIComponent(results[1].replace(/\+/g, ' '));
                        }
                        var searchTerm = getUrlParameter('n');
                        if (searchTerm) {
                            document.getElementById('searchInput').value = searchTerm;
                        }
                        $('#searchForm').submit(function(event) {
                            var input = $('#searchInput').val().trim();
                            let searchInput = $('#searchInput');
                            if (input === '') {
                                searchInput.addClass("is-invalid");
                                $('.invalid-feedback').show(); // Show the invalid feedback
                                event.preventDefault(); // Prevent form submission
                            } else {
                                $('.invalid-feedback').hide(); // Hide the invalid feedback if input is provided
                            }
                        });
                    });
                </script>
                <script>
                    $(document).ready(function() {
                        // Function to get URL parameter
                        function getUrlParameter(name) {
                            name = name.replace(/[\[]/, '\\[').replace(/[\]]/, '\\]');
                            var regex = new RegExp('[\\?&]' + name + '=([^&#]*)');
                            var results = regex.exec(location.search);
                            return results === null ? '' : decodeURIComponent(results[1].replace(/\+/g, ' '));
                        }

                        // Get the search parameter 'n' from the URL
                        var searchTerm = getUrlParameter('n');

                        // If searchTerm is found, set the value of the search input
                        if (searchTerm) {
                            document.getElementById('searchInput').value = searchTerm;
                        }

                        // Restore radio button state from local storage
                        var rg1State = localStorage.getItem('rg1State');
                        if (rg1State) {
                            $("input[name='rg1'][value='" + rg1State + "']").prop('checked', true);
                        }

                        var rg2State = localStorage.getItem('rg2State');
                        if (rg2State) {
                            $("input[name='rg2'][value='" + rg2State + "']").prop('checked', true);
                        }

                        // Save radio button state to local storage on change
                        $('input[name="rg1"], input[name="rg2"]').change(function() {
                            var rg1Value = $("input[name='rg1']:checked").val();
                            var rg2Value = $("input[name='rg2']:checked").val();

                            localStorage.setItem('rg1State', rg1Value);
                            localStorage.setItem('rg2State', rg2Value);
                        });

                        // jQuery validation for the search form
                        $('#searchForm').submit(function(event) {
                            var input = $('#searchInput').val().trim();
                            let searchInput = $('#searchInput');
                            if (input === '') {
                                searchInput.addClass("is-invalid");
                                $('.invalid-feedback').show(); // Show the invalid feedback
                                event.preventDefault(); // Prevent form submission
                            } else {
                                $('.invalid-feedback').hide(); // Hide the invalid feedback if input is provided
                            }
                        });

                        // Function to update the placeholder based on selected radio buttons
                        function updatePlaceholder() {
                            let searchCategory = $('input[name="rg1"]:checked').parent().text().trim();
                            let userStatus = $('input[name="rg2"]:checked').parent().text().trim();
                            let placeholderText = `Search ${searchCategory} of ${userStatus} users`;
                            $('#searchInput').attr('placeholder', placeholderText);
                        }

                        // Initialize placeholder on page load
                        updatePlaceholder();

                        // Update placeholder on radio button change
                        $('input[name="rg1"], input[name="rg2"]').change(function() {
                            updatePlaceholder();
                        });
                    });
                </script>
            @else
                <div class="container mt-5">
                    <h1>No Users Found</h1>
                    <p class="contact-info ">
                        We couldn't find any users matching your search criteria. If you believe this is an error or need
                        assistance, please reach out to our support team at
                        <a href="mailto:omar.7tech@gmail.com">omar.7tech@gmail.com</a>.
                    </p>
                </div>
            @endif
        @endsection
