@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-lg border-0">
                <div class="card-header bg-primary text-white text-center py-4">
                    <h3 class="mb-0">Register Your Gas Agency</h3>
                    <p class="mb-0">Join our SaaS platform and manage your agency efficiently</p>
                </div>

                <div class="card-body p-5">
                    <form method="POST" action="{{ route('agency.register.submit') }}">
                        @csrf

                        <div class="row mb-4">
                            <div class="col-md-12">
                                <h5 class="text-primary mb-3"><i class="fas fa-building me-2"></i>Agency Information</h5>
                                <div class="form-floating mb-3">
                                    <input id="agency_name" type="text" class="form-control @error('agency_name') is-invalid @enderror" name="agency_name" value="{{ old('agency_name') }}" required placeholder="Agency Name">
                                    <label for="agency_name">Agency Name (e.g. Muscat Gas)</label>
                                    @error('agency_name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-floating mb-3">
                                    <textarea id="location" class="form-control @error('location') is-invalid @enderror" name="location" required placeholder="Location" style="height: 100px">{{ old('location') }}</textarea>
                                    <label for="location">Location / Address</label>
                                    @error('location')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <hr class="my-4">

                        <div class="row mb-4">
                            <div class="col-md-12">
                                <h5 class="text-primary mb-3"><i class="fas fa-user-tie me-2"></i>Owner Information</h5>
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <div class="form-floating">
                                            <input id="owner_name" type="text" class="form-control @error('owner_name') is-invalid @enderror" name="owner_name" value="{{ old('owner_name') }}" required placeholder="Owner Name">
                                            <label for="owner_name">Owner Full Name</label>
                                            @error('owner_name')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <div class="form-floating">
                                            <input id="phone" type="text" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{ old('phone') }}" required placeholder="Phone">
                                            <label for="phone">Contact Phone</label>
                                            @error('phone')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="form-floating mb-3">
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required placeholder="Email">
                                    <label for="email">Business Email (Login Email)</label>
                                    @error('email')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="form-floating mb-4">
                            <textarea id="note" class="form-control" name="note" placeholder="Additional Notes" style="height: 80px">{{ old('note') }}</textarea>
                            <label for="note">Additional Notes (Optional)</label>
                        </div>

                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary btn-lg shadow-sm">
                                <i class="fas fa-paper-plane me-2"></i>Submit Registration Request
                            </button>
                        </div>
                        
                        <div class="text-center mt-4">
                            <p class="mb-0 text-muted">Already have an approved agency? <a href="{{ route('login') }}" class="text-primary fw-bold">Login Here</a></p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
