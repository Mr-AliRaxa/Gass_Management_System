@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Super Admin Dashboard</h1>
    </div>

    <div class="row">
        <!-- Total Agencies Card -->
        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Total Agencies</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $totalAgencies }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-building fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Pending Requests Card -->
        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                Pending Requests</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $pendingRequests }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Total Users Card -->
        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                Total System Users</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $totalUsers }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-users fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <!-- Recent Requests -->
        <div class="col-lg-6">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex justify-content-between align-items-center">
                    <h6 class="m-0 font-weight-bold text-primary">Recent Registration Requests</h6>
                    <a href="{{ route('super_admin.requests.index') }}" class="btn btn-sm btn-primary">View All</a>
                </div>
                <div class="card-body">
                    <ul class="list-group list-group-flush">
                        @forelse($recentRequests as $request)
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <div>
                                    <strong>{{ $request->agency_name }}</strong><br>
                                    <small class="text-muted">{{ $request->owner_name }} ({{ $request->created_at->diffForHumans() }})</small>
                                </div>
                                <span class="badge {{ $request->status == 'pending' ? 'bg-warning text-dark' : ($request->status == 'approved' ? 'bg-success' : 'bg-danger') }}">
                                    {{ ucfirst($request->status) }}
                                </span>
                            </li>
                        @empty
                            <li class="list-group-item text-center">No recent requests</li>
                        @endforelse
                    </ul>
                </div>
            </div>
        </div>

        <!-- Recent Agencies -->
        <div class="col-lg-6">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex justify-content-between align-items-center">
                    <h6 class="m-0 font-weight-bold text-primary">Recently Added Agencies</h6>
                    <a href="{{ route('super_admin.agencies.index') }}" class="btn btn-sm btn-primary">View All</a>
                </div>
                <div class="card-body">
                    <ul class="list-group list-group-flush">
                        @forelse($recentAgencies as $agency)
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <div>
                                    <strong>{{ $agency->name }}</strong><br>
                                    <small class="text-muted">Registered {{ $agency->created_at->diffForHumans() }}</small>
                                </div>
                                <span class="badge bg-success">Active</span>
                            </li>
                        @empty
                            <li class="list-group-item text-center">No agencies registered yet</li>
                        @endforelse
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
