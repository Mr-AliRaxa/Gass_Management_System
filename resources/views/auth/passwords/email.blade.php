@extends('layouts.app')

@section('content')
<style>
    #page-content-wrapper {
        padding: 0 !important;
    }
    main.container-fluid {
        padding: 0 !important;
        max-width: 100% !important;
    }
    .auth-page-container {
        min-height: 100vh;
        width: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
        background: linear-gradient(135deg, #f0f4ff 0%, #e2e8f0 100%);
        padding: 24px;
    }
    .auth-card {
        width: 100%;
        max-width: 460px;
        background: #ffffff;
        border-radius: 20px;
        box-shadow: 0 10px 30px rgba(15, 23, 42, 0.08);
        padding: 40px 36px;
        border: 1px solid #eef2f6;
    }
    .auth-icon-circle {
        width: 64px;
        height: 64px;
        border-radius: 18px;
        background: linear-gradient(135deg, #2563eb 0%, #1d4ed8 100%);
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 20px;
        color: #ffffff;
        font-size: 26px;
        box-shadow: 0 8px 20px rgba(37, 99, 235, 0.25);
    }
    .auth-title {
        font-size: 22px;
        font-weight: 800;
        color: #0f172a;
        text-align: center;
        margin-bottom: 8px;
    }
    .auth-subtitle {
        font-size: 13.5px;
        color: #64748b;
        text-align: center;
        line-height: 1.5;
        margin-bottom: 28px;
    }
    .input-icon-group {
        position: relative;
    }
    .input-icon-group i {
        position: absolute;
        top: 50%;
        transform: translateY(-50%);
        color: #94a3b8;
        font-size: 15px;
    }
    [dir="ltr"] .input-icon-group i, html:not([dir="rtl"]) .input-icon-group i {
        left: 16px;
    }
    [dir="ltr"] .input-icon-group .form-control, html:not([dir="rtl"]) .input-icon-group .form-control {
        padding-left: 44px;
    }
    [dir="rtl"] .input-icon-group i {
        right: 16px;
    }
    [dir="rtl"] .input-icon-group .form-control {
        padding-right: 44px;
    }
    .auth-card .form-control {
        height: 48px;
        border-radius: 12px;
        border: 1.5px solid #e2e8f0;
        font-size: 14px;
        transition: all 0.2s ease;
    }
    .auth-card .form-control:focus {
        border-color: #2563eb;
        box-shadow: 0 0 0 4px rgba(37, 99, 235, 0.1);
    }
    .btn-auth-submit {
        height: 48px;
        border-radius: 12px;
        background: linear-gradient(135deg, #2563eb 0%, #1d4ed8 100%);
        border: none;
        color: #ffffff;
        font-weight: 700;
        font-size: 14.5px;
        box-shadow: 0 6px 18px rgba(37, 99, 235, 0.25);
        transition: all 0.2s ease;
    }
    .btn-auth-submit:hover {
        background: linear-gradient(135deg, #1d4ed8 0%, #1e40af 100%);
        transform: translateY(-1px);
        box-shadow: 0 8px 24px rgba(37, 99, 235, 0.35);
        color: #ffffff;
    }
</style>

<div class="auth-page-container">
    <div class="auth-card">
        <div class="auth-icon-circle">
            <i class="fas fa-key"></i>
        </div>

        <h2 class="auth-title">{{ __('messages.forgot_password') }}</h2>
        <p class="auth-subtitle">{{ __('messages.forgot_password_desc') }}</p>

        @if (session('status'))
            <div class="alert alert-success d-flex align-items-center gap-2" style="border-radius: 12px; font-size: 13.5px;" role="alert">
                <i class="fas fa-check-circle" style="font-size: 16px;"></i>
                <div>{{ session('status') }}</div>
            </div>
        @endif

        <form method="POST" action="{{ route('password.email') }}">
            @csrf

            <div class="mb-4">
                <label for="email" class="form-label font-weight-bold" style="font-size: 13px; color: #334155;">{{ __('messages.email') }}</label>
                <div class="input-icon-group">
                    <i class="fas fa-envelope"></i>
                    <input id="email" type="email"
                           class="form-control @error('email') is-invalid @enderror"
                           name="email" value="{{ old('email') }}" required autocomplete="email" autofocus
                           placeholder="{{ __('messages.enter_email') }}">
                </div>
                @error('email')
                    <span class="invalid-feedback d-block mt-2" role="alert" style="font-size: 12.5px;">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <button type="submit" class="btn btn-auth-submit w-100 mb-3">
                <i class="fas fa-paper-plane me-2"></i> {{ __('messages.send_reset_link') }}
            </button>

            <div class="text-center mt-3">
                <a href="{{ route('login') }}" class="text-decoration-none" style="font-size: 13.5px; color: #64748b; font-weight: 600;">
                    <i class="fas fa-arrow-left me-1"></i> {{ __('messages.back_to_login') }}
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
