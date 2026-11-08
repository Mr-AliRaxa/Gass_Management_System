@extends('layouts.app')

@section('content')
<div class="container-fluid px-4">
    {{-- Hero Banner --}}
    <div class="profile-hero mb-4">
        <div class="hero-overlay"></div>
        <div class="hero-content">
            <div class="d-flex align-items-center gap-3 flex-wrap">
                <div class="avatar-circle">
                    <span>{{ strtoupper(substr($user->name, 0, 1)) }}</span>
                    <div class="avatar-status"></div>
                </div>
                <div>
                    <h2 class="mb-1 text-white fw-bold">{{ $user->name }}</h2>
                    <p class="mb-0 text-white-50">
                        <i class="fas fa-envelope me-1"></i>{{ $user->email }}
                    </p>
                </div>
            </div>
        </div>
    </div>

    {{-- Breadcrumb --}}
    <nav aria-label="breadcrumb" class="mb-4">
        <ol class="breadcrumb profile-breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{ route('home') }}"><i class="fas fa-home me-1"></i>{{ __('messages.dashboard') }}</a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">{{ __('messages.profile') }}</li>
        </ol>
    </nav>

    <div class="row g-4">
        {{-- Sidebar / Info Card --}}
        <div class="col-lg-4">
            <div class="card profile-card border-0 shadow-sm mb-4">
                <div class="card-body text-center py-4">
                    <div class="avatar-circle avatar-lg mx-auto mb-3">
                        <span>{{ strtoupper(substr($user->name, 0, 1)) }}</span>
                    </div>
                    <h5 class="fw-bold mb-1">{{ $user->name }}</h5>
                    <p class="text-muted small mb-3">{{ $user->email }}</p>
                    <span class="badge bg-soft-primary text-primary px-3 py-2 rounded-pill">
                        <i class="fas fa-user me-1"></i> Active Account
                    </span>
                </div>
                <ul class="list-group list-group-flush profile-info-list">
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <span class="text-muted"><i class="fas fa-id-card me-2"></i>{{ __('messages.full_name') }}</span>
                        <strong>{{ $user->name }}</strong>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <span class="text-muted"><i class="fas fa-envelope me-2"></i>{{ __('messages.email_address') }}</span>
                        <strong class="text-truncate" style="max-width: 180px;">{{ $user->email }}</strong>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <span class="text-muted"><i class="fas fa-calendar-alt me-2"></i>Member Since</span>
                        <strong>{{ $user->created_at?->format('M Y') ?? '—' }}</strong>
                    </li>
                </ul>
            </div>
        </div>

        {{-- Main Form --}}
        <div class="col-lg-8">
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm" role="alert">
                    <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <div class="card profile-card border-0 shadow-sm">
                <div class="card-header profile-card-header">
                    <div class="d-flex align-items-center">
                        <div class="header-icon">
                            <i class="fas fa-user-edit"></i>
                        </div>
                        <div class="ms-3">
                            <h5 class="mb-0 fw-bold">{{ __('messages.update_profile_info') }}</h5>
                            <small class="text-muted">Update your personal information and password</small>
                        </div>
                    </div>
                </div>
                <div class="card-body p-4">
                    <form action="{{ route('profile.update') }}" method="POST">
                        @csrf
                        @method('PUT')

                        {{-- Personal Info Section --}}
                        <div class="section-title mb-3">
                            <i class="fas fa-info-circle me-2 text-primary"></i>
                            <span>Personal Information</span>
                        </div>

                        <div class="row g-3 mb-4">
                            <div class="col-md-6">
                                <label for="name" class="form-label fw-semibold">{{ __('messages.full_name') }}</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light"><i class="fas fa-user text-muted"></i></span>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror"
                                           id="name" name="name" value="{{ old('name', $user->name) }}"
                                           placeholder="Enter your full name" required>
                                    @error('name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <label for="email" class="form-label fw-semibold">{{ __('messages.email_address') }}</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light"><i class="fas fa-envelope text-muted"></i></span>
                                    <input type="email" class="form-control" id="email" value="{{ $user->email }}" disabled>
                                </div>
                                <div class="form-text text-muted small">
                                    <i class="fas fa-lock me-1"></i>{{ __('messages.email_cannot_change') }}
                                </div>
                            </div>
                        </div>

                        <hr class="my-4">

                        {{-- Password Section --}}
                        <div class="section-title mb-3">
                            <i class="fas fa-shield-alt me-2 text-primary"></i>
                            <span>{{ __('messages.change_password') }}</span>
                        </div>
                        <p class="text-muted small mb-3">{{ __('messages.change_password_hint') }}</p>

                        <div class="row g-3 mb-4">
                            <div class="col-12">
                                <label for="current_password" class="form-label fw-semibold">{{ __('messages.current_password') }}</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light"><i class="fas fa-key text-muted"></i></span>
                                    <input type="password" class="form-control @error('current_password') is-invalid @enderror"
                                           id="current_password" name="current_password"
                                           placeholder="Enter current password">
                                    @error('current_password')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <label for="new_password" class="form-label fw-semibold">{{ __('messages.new_password') }}</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light"><i class="fas fa-lock text-muted"></i></span>
                                    <input type="password" class="form-control @error('new_password') is-invalid @enderror"
                                           id="new_password" name="new_password"
                                           placeholder="Enter new password">
                                    @error('new_password')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <label for="new_password_confirmation" class="form-label fw-semibold">{{ __('messages.confirm_password') }}</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light"><i class="fas fa-lock text-muted"></i></span>
                                    <input type="password" class="form-control"
                                           id="new_password_confirmation" name="new_password_confirmation"
                                           placeholder="Confirm new password">
                                </div>
                            </div>
                        </div>

                        <div class="d-flex justify-content-end gap-2 pt-3 border-top">
                            <button type="reset" class="btn btn-light px-4">
                                <i class="fas fa-undo me-2"></i>Reset
                            </button>
                            <button type="submit" class="btn btn-primary px-4">
                                <i class="fas fa-save me-2"></i>{{ __('messages.update_profile') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    /* ===== Hero Banner ===== */
    .profile-hero {
        position: relative;
        border-radius: 1rem;
        padding: 2.25rem 2rem;
        overflow: hidden;
        background: linear-gradient(135deg, #4f46e5 0%, #7c3aed 50%, #db2777 100%);
        box-shadow: 0 10px 30px -10px rgba(79, 70, 229, 0.5);
    }
    .profile-hero .hero-overlay {
        position: absolute;
        inset: 0;
        background:
            radial-gradient(circle at 20% 20%, rgba(255,255,255,0.15), transparent 40%),
            radial-gradient(circle at 80% 80%, rgba(255,255,255,0.1), transparent 40%);
    }
    .profile-hero .hero-content {
        position: relative;
        z-index: 2;
    }

    /* ===== Avatar ===== */
    .avatar-circle {
        position: relative;
        width: 72px;
        height: 72px;
        border-radius: 50%;
        background: rgba(255, 255, 255, 0.25);
        backdrop-filter: blur(10px);
        border: 3px solid rgba(255, 255, 255, 0.6);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.75rem;
        font-weight: 700;
        color: #fff;
        flex-shrink: 0;
    }
    .avatar-circle.avatar-lg {
        width: 90px;
        height: 90px;
        font-size: 2.25rem;
        background: linear-gradient(135deg, #4f46e5, #7c3aed);
        border: 4px solid #fff;
        box-shadow: 0 6px 20px rgba(79, 70, 229, 0.35);
    }
    .avatar-status {
        position: absolute;
        bottom: 4px;
        right: 4px;
        width: 16px;
        height: 16px;
        border-radius: 50%;
        background: #10b981;
        border: 3px solid #fff;
    }

    /* ===== Breadcrumb ===== */
    .profile-breadcrumb {
        background: transparent;
        padding: 0;
        font-size: 0.875rem;
    }
    .profile-breadcrumb a {
        color: #4f46e5;
        text-decoration: none;
        font-weight: 500;
    }
    .profile-breadcrumb a:hover { text-decoration: underline; }

    /* ===== Cards ===== */
    .profile-card {
        border-radius: 1rem;
        overflow: hidden;
        transition: transform 0.2s ease, box-shadow 0.2s ease;
    }
    .profile-card:hover {
        box-shadow: 0 1rem 2.5rem rgba(0,0,0,0.08) !important;
    }
    .profile-card-header {
        background: linear-gradient(135deg, #f8fafc 0%, #eef2ff 100%);
        border-bottom: 1px solid #e5e7eb;
        padding: 1.1rem 1.5rem;
    }
    .header-icon {
        width: 42px;
        height: 42px;
        border-radius: 0.65rem;
        background: linear-gradient(135deg, #4f46e5, #7c3aed);
        color: #fff;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.1rem;
        box-shadow: 0 4px 10px rgba(79, 70, 229, 0.3);
    }

    /* ===== Info List ===== */
    .profile-info-list .list-group-item {
        padding: 0.9rem 1.25rem;
        border-color: #f1f5f9;
        font-size: 0.9rem;
    }
    .profile-info-list .list-group-item:last-child { border-bottom: 0; }

    /* ===== Badge ===== */
    .bg-soft-primary {
        background: rgba(79, 70, 229, 0.1);
    }

    /* ===== Section Title ===== */
    .section-title {
        display: flex;
        align-items: center;
        font-weight: 600;
        color: #1e293b;
        font-size: 1rem;
        padding-bottom: 0.5rem;
        border-bottom: 1px dashed #e2e8f0;
    }

    /* ===== Form Inputs ===== */
    .form-control, .input-group-text {
        border-color: #e2e8f0;
    }
    .form-control:focus {
        border-color: #4f46e5;
        box-shadow: 0 0 0 0.2rem rgba(79, 70, 229, 0.15);
    }
    .input-group-text {
        color: #94a3b8;
    }

    /* ===== Buttons ===== */
    .btn-primary {
        background: linear-gradient(135deg, #4f46e5, #7c3aed);
        border: none;
        font-weight: 500;
        transition: all 0.2s ease;
    }
    .btn-primary:hover {
        background: linear-gradient(135deg, #4338ca, #6d28d9);
        transform: translateY(-1px);
        box-shadow: 0 6px 15px rgba(79, 70, 229, 0.35);
    }

    /* ===== Responsive ===== */
    @media (max-width: 576px) {
        .profile-hero { padding: 1.5rem 1rem; }
        .avatar-circle.avatar-lg { width: 70px; height: 70px; font-size: 1.75rem; }
    }
</style>
@endpush