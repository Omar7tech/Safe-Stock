@extends('admin.layout.app')

@section('content')

    @component('components.breadcrumbs')
        @slot('items', [['name' => 'Home', 'url' => '/'], ['name' => 'Requests', 'url' => '/requests'], ['name' => 'All', 'url'
            => '']])
        @endcomponent

        @if (!$requests->isEmpty())
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th></th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Request at</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($requests as $request)
                            <tr>
                                <td>{!! Avatar::create($request->name)->setFontFamily('Laravolt')->toSvg() !!}</td>
                                <td>{{ $request->name }}</td>
                                <td>{{ $request->email }}</td>
                                <td>{{ $request->created_at }}</td>
                                <td>
                                    @if ($request->status == 'pending')
                                        <span class="badge bg-warning text-dark">Pending</span>
                                    @elseif ($request->status == 'accepted')
                                        <span class="badge bg-success text-dark">Accepted</span>
                                    @elseif ($request->status == 'rejected')
                                        <span class="badge bg-danger text-dark">Rejected</span>
                                    @endif
                                </td>
                                <td>
                                    @if ($request->status == 'pending')
                                        <div class="btn-group" role="group" aria-label="Basic example">
                                            <button type="button" class="btn btn-dark">
                                                <i class="bi bi-slash-circle-fill text-danger"></i>
                                            </button>
                                            <button type="button" class="btn btn-dark">
                                                <i class="bi bi-shield-fill-check text-success"></i>
                                            </button>
                                        </div>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
        <div class="container mt-5 text-center">
            <h1 class="display-4">No Requests Found</h1>
            <p class="lead">We couldn't find any request</p>
            <a href="javascript:history.back()" class="btn btn-primary mt-3">
                <i class="bi bi-arrow-left-circle"></i> Go Back
            </a>
            <button onclick="location.reload()" class="btn btn-primary mt-3">
                <i class="bi bi-arrow-clockwise"></i> Refresh Page
            </button>
        </div>
        @endif


    @endsection
