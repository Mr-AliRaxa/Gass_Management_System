@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">Create New Gas Agency</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('super_admin.agencies.store') }}" method="POST">
                        @csrf
                        <h6 class="mb-3 text-primary">Agency Information</h6>
                        <div class="mb-3">
                            <label for="name" class="form-label">Agency Name</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}" required>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <hr>
                        <h6 class="mb-3 text-primary">Owner (Admin) Information</h6>
                        <div class="mb-3">
                            <label for="owner_name" class="form-label">Owner Name</label>
                            <input type="text" class="form-control @error('owner_name') is-invalid @enderror" id="owner_name" name="owner_name" value="{{ old('owner_name') }}" required>
                            @error('owner_name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="owner_email" class="form-label">Owner Email</label>
                            <input type="email" class="form-control @error('owner_email') is-invalid @enderror" id="owner_email" name="owner_email" value="{{ old('owner_email') }}" required>
                            @error('owner_email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="owner_password" class="form-label">Owner Password</label>
                            <input type="password" class="form-control @error('owner_password') is-invalid @enderror" id="owner_password" name="owner_password" required>
                            @error('owner_password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary">Create Agency & Owner</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
