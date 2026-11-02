@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-white py-3">
                    <h5 class="mb-0 text-primary fw-bold">Process Registration Request</h5>
                </div>
                <div class="card-body p-4">
                    <div class="alert alert-info border-0 shadow-sm mb-4">
                        <h6 class="alert-heading fw-bold">Requested Details:</h6>
                        <p class="mb-0 small">
                            <strong>Agency:</strong> {{ $agencyRequest->agency_name }}<br>
                            <strong>Owner:</strong> {{ $agencyRequest->owner_name }}<br>
                            <strong>Email:</strong> {{ $agencyRequest->email }}<br>
                            <strong>Location:</strong> {{ $agencyRequest->location }}<br>
                            @if($agencyRequest->note) <strong>Note:</strong> {{ $agencyRequest->note }} @endif
                        </p>
                    </div>

                    <form action="{{ route('super_admin.requests.approve', $agencyRequest->id) }}" method="POST">
                        @csrf
                        <h6 class="mb-3 text-secondary fw-bold text-uppercase" style="font-size: 0.8rem;">Step 1: Create Agency Profile</h6>
                        <div class="mb-4">
                            <label for="name" class="form-label small fw-bold">Target Agency Name</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name', $agencyRequest->agency_name) }}" required>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <h6 class="mb-3 text-secondary fw-bold text-uppercase" style="font-size: 0.8rem;">Step 2: Setup Owner Login</h6>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="owner_name" class="form-label small fw-bold">Full Name</label>
                                <input type="text" class="form-control @error('owner_name') is-invalid @enderror" id="owner_name" name="owner_name" value="{{ old('owner_name', $agencyRequest->owner_name) }}" required>
                                @error('owner_name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="email" class="form-label small fw-bold">Login Email</label>
                                <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email', $agencyRequest->email) }}" required>
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-4">
                            <label for="password" class="form-label small fw-bold">Initial Login Password</label>
                            <div class="input-group">
                                <input type="text" class="form-control @error('password') is-invalid @enderror" id="password" name="password" value="{{ Str::random(10) }}" required>
                                <button class="btn btn-outline-secondary" type="button" onclick="this.previousElementSibling.value = Math.random().toString(36).slice(-10)">Regenerate</button>
                            </div>
                            <small class="text-muted">You must share this password with the owner manually.</small>
                            @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <hr class="my-4">

                        <div class="d-flex justify-content-between">
                            <a href="{{ route('super_admin.requests.index') }}" class="btn btn-light px-4">Cancel</a>
                            <button type="submit" class="btn btn-primary px-5 shadow-sm">
                                <i class="fas fa-check-circle me-2"></i>Create Agency & Activate Login
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
