@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb mb-4">
        <div class="d-flex justify-content-between align-items-center">
            <h2>Role Management</h2>
            @can('role-create')
            <a class="btn btn-success" href="{{ route('roles.create') }}"><i class="fas fa-plus"></i> Create New Role</a>
            @endcan
        </div>
    </div>
</div>

@if ($message = Session::get('success'))
<div class="alert alert-success">
    <p>{{ $message }}</p>
</div>
@endif

<div class="card shadow mb-4">
    <div class="card-body">
        <table class="table table-bordered">
          <tr>
             <th>No</th>
             <th>Name</th>
             <th width="280px">Action</th>
          </tr>
            @foreach ($roles as $key => $role)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $role->name }}</td>
                <td>
                    <a class="btn btn-info btn-sm" href="{{ route('roles.show',$role->id) }}"><i class="fas fa-eye"></i></a>
                    @if($role->name !== 'Super Admin')
                        @can('role-edit')
                        <a class="btn btn-primary btn-sm" href="{{ route('roles.edit',$role->id) }}"><i class="fas fa-edit"></i></a>
                        @endcan
                        @can('role-delete')
                        <button type="button" class="btn btn-danger btn-sm" onclick="confirmDelete('{{ route('roles.destroy', $role->id) }}')">
                            <i class="fas fa-trash"></i>
                        </button>
                        @endcan
                    @else
                        <span class="badge bg-info">System Reserved</span>
                    @endif
                </td>
            </tr>
            @endforeach
        </table>
        <div class="pagination-wrap">
            {!! $roles->links() !!}
        </div>
    </div>
</div>
@endsection
