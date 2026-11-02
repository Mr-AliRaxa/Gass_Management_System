@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card shadow-sm">
                <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
                    <h5 class="mb-0 text-primary fw-bold">Registration Requests</h5>
                </div>
                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success border-0 shadow-sm mb-4">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if(session('error'))
                        <div class="alert alert-danger border-0 shadow-sm mb-4">
                            {{ session('error') }}
                        </div>
                    @endif

                    <div class="table-responsive">
                        <table class="table table-hover align-middle">
                            <thead class="table-light">
                                <tr>
                                    <th>Date</th>
                                    <th>Agency</th>
                                    <th>Owner</th>
                                    <th>Contact</th>
                                    <th>Status</th>
                                    <th class="text-end">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($requests as $request)
                                <tr>
                                    <td>{{ $request->created_at->format('M d, Y') }}</td>
                                    <td>
                                        <div class="fw-bold">{{ $request->agency_name }}</div>
                                        <small class="text-muted"><i class="fas fa-map-marker-alt me-1"></i>{{ Str::limit($request->location, 30) }}</small>
                                    </td>
                                    <td>{{ $request->owner_name }}</td>
                                    <td>
                                        <div><i class="fas fa-envelope me-1"></i>{{ $request->email }}</div>
                                        <small class="text-muted"><i class="fas fa-phone me-1"></i>{{ $request->phone }}</small>
                                    </td>
                                    <td>
                                        @if($request->status == 'pending')
                                            <span class="badge bg-warning text-dark">Pending</span>
                                        @elseif($request->status == 'approved')
                                            <span class="badge bg-success">Approved</span>
                                        @else
                                            <span class="badge bg-danger">Rejected</span>
                                        @endif
                                    </td>
                                    <td class="text-end">
                                        @if($request->status == 'pending')
                                            <div class="btn-group gap-2">
                                                <a href="{{ route('super_admin.requests.process', $request->id) }}" class="btn btn-success btn-sm px-3 shadow-sm rounded-pill">
                                                    <i class="fas fa-cog me-1"></i> Process
                                                </a>
                                                <form action="{{ route('super_admin.requests.reject', $request->id) }}" method="POST">
                                                    @csrf
                                                    <button type="submit" class="btn btn-outline-danger btn-sm px-3 rounded-pill" onclick="return confirm('Reject this request?')">
                                                        <i class="fas fa-times me-1"></i> Reject
                                                    </button>
                                                </form>
                                            </div>
                                        @else
                                            <span class="badge bg-light text-dark disabled rounded-pill">Processed</span>
                                        @endif
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="6" class="text-center py-5">
                                        <div class="mb-3"><i class="fas fa-inbox fa-3x text-light"></i></div>
                                        <h5 class="text-muted">No registration requests found.</h5>
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
