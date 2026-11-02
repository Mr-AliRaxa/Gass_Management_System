@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Agencies Management</h5>
                    <a href="{{ route('super_admin.agencies.create') }}" class="btn btn-primary btn-sm">Add New Agency</a>
                </div>
                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success mt-3">
                            {{ session('success') }}
                        </div>
                    @endif
                    <div class="table-responsive mt-3">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Agency Name</th>
                                    <th>Owner Name</th>
                                    <th>Owner Email</th>
                                    <th>Created At</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($agencies as $agency)
                                <tr>
                                    <td>{{ $agency->id }}</td>
                                    <td>{{ $agency->name }}</td>
                                    <td>
                                        @foreach($agency->users as $user)
                                            @if($user->hasRole('Admin'))
                                                {{ $user->name }}
                                            @endif
                                        @endforeach
                                    </td>
                                    <td>
                                        @foreach($agency->users as $user)
                                            @if($user->hasRole('Admin'))
                                                {{ $user->email }}
                                            @endif
                                        @endforeach
                                    </td>
                                    <td>{{ $agency->created_at->format('Y-m-d') }}</td>
                                    <td>
                                        <span class="badge {{ $agency->status == 'active' ? 'bg-success' : 'bg-danger' }}">
                                            {{ ucfirst($agency->status ?? 'active') }}
                                        </span>
                                    </td>
                                    <td>
                                        <div class="btn-group">
                                            <a href="{{ route('super_admin.agencies.edit', $agency->id) }}" class="btn btn-info btn-sm text-white">
                                                <i class="fas fa-edit"></i> Edit
                                            </a>
                                            <form action="{{ route('super_admin.agencies.destroy', $agency->id) }}" method="POST" onsubmit="return confirm('Attention: Deleting this agency will remove ALL related data (Sales, Customers, etc.). This cannot be undone. Are you sure?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm">
                                                    <i class="fas fa-trash"></i> Delete
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
