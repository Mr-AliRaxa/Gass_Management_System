@extends('layouts.app')

@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4">{{ __('messages.user_profile') }}</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">{{ __('messages.dashboard') }}</a></li>
        <li class="breadcrumb-item active">{{ __('messages.profile') }}</li>
    </ol>

    <div class="row">
        <div class="col-xl-6">
            <div class="card mb-4 shadow-sm border-0">
                <div class="card-header bg-primary text-white">
                    <i class="fas fa-user-edit me-1"></i>
                    {{ __('messages.update_profile_info') }}
                </div>
                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <form action="{{ route('profile.update') }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label for="name" class="form-label">{{ __('messages.full_name') }}</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name', $user->name) }}" required>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">{{ __('messages.email_address') }}</label>
                            <input type="email" class="form-control" id="email" value="{{ $user->email }}" disabled>
                            <div class="form-text text-muted">{{ __('messages.email_cannot_change') }}</div>
                        </div>

                        <hr class="my-4">
                        <h5 class="mb-3">{{ __('messages.change_password') }}</h5>
                        <p class="text-muted small">{{ __('messages.change_password_hint') }}</p>

                        <div class="mb-3">
                            <label for="current_password" class="form-label">{{ __('messages.current_password') }}</label>
                            <input type="password" class="form-control @error('current_password') is-invalid @enderror" id="current_password" name="current_password">
                            @error('current_password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="new_password" class="form-label">{{ __('messages.new_password') }}</label>
                            <input type="password" class="form-control @error('new_password') is-invalid @enderror" id="new_password" name="new_password">
                            @error('new_password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="new_password_confirmation" class="form-label">{{ __('messages.confirm_password') }}</label>
                            <input type="password" class="form-control" id="new_password_confirmation" name="new_password_confirmation">
                        </div>

                        <button type="submit" class="btn btn-primary">{{ __('messages.update_profile') }}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
