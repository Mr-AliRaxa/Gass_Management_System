@extends('layouts.app')

@section('content')
    <style>
        /* ============================================================
               FULL SCREEN OVERRIDE
               ============================================================ */
        #page-content-wrapper {
            padding: 0 !important;
        }

        main.container-fluid {
            padding: 0 !important;
            max-width: 100% !important;
        }

        /* ============================================================
               PAGE WRAPPER
               ============================================================ */
        .login-wrapper {
            position: relative;
            min-height: 100vh;
            width: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 40px 16px;
            overflow: hidden;
            background: linear-gradient(135deg, #1c3d5a 0%, #0f2537 100%);
            font-family: 'Segoe UI', system-ui, -apple-system, sans-serif;
        }

        /* ============================================================
               BACKGROUND IMAGE  (slow zoom animation)
               ============================================================ */
        .login-bg {
            position: absolute;
            inset: -4%;
            background-image: url("{{ asset('images/login-bg.png') }}");
            background-size: cover;
            background-position: center center;
            background-repeat: no-repeat;
            animation: slowZoom 25s ease-in-out infinite alternate;
            z-index: 0;
        }

        @keyframes slowZoom {
            from {
                transform: scale(1);
            }

            to {
                transform: scale(1.12);
            }
        }

        /* ============================================================
               COLOR OVERLAY (image ko professional look dene ke liye)
               ============================================================ */
        .login-overlay {
            position: absolute;
            inset: 0;
            background: linear-gradient(135deg,
                    rgba(15, 37, 55, 0.88) 0%,
                    rgba(28, 61, 90, 0.72) 45%,
                    rgba(246, 117, 15, 0.45) 100%);
            z-index: 1;
        }

        /* soft glowing orbs for depth */
        .login-overlay::before,
        .login-overlay::after {
            content: "";
            position: absolute;
            border-radius: 50%;
            filter: blur(90px);
            opacity: .55;
        }

        .login-overlay::before {
            width: 420px;
            height: 420px;
            background: #f6750f;
            top: -140px;
            right: -100px;
        }

        .login-overlay::after {
            width: 380px;
            height: 380px;
            background: #2e7bd6;
            bottom: -160px;
            left: -120px;
        }

        /* ============================================================
               LOGIN CARD (glassmorphism)
               ============================================================ */
        .login-card {
            position: relative;
            z-index: 5;
            width: 100%;
            max-width: 450px;
            padding: 48px 42px 38px;
            border-radius: 22px;
            background: rgba(255, 255, 255, 0.96);
            -webkit-backdrop-filter: blur(18px);
            backdrop-filter: blur(18px);
            border: 1px solid rgba(255, 255, 255, 0.6);
            box-shadow:
                0 30px 70px rgba(0, 0, 0, 0.45),
                0 0 0 1px rgba(255, 255, 255, 0.25) inset;
            animation: cardIn 0.8s cubic-bezier(0.21, 0.98, 0.6, 0.99) both;
        }

        @keyframes cardIn {
            from {
                opacity: 0;
                transform: translateY(35px) scale(0.97);
            }

            to {
                opacity: 1;
                transform: translateY(0) scale(1);
            }
        }

        /* ============================================================
               BRAND
               ============================================================ */
        .brand-wrap {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 26px;
        }

        .brand-icon {
            width: 52px;
            height: 52px;
            border-radius: 14px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.4rem;
            color: #fff;
            background: linear-gradient(135deg, #f6750f, #ff9a3c);
            box-shadow: 0 8px 20px rgba(246, 117, 15, 0.45);
            flex-shrink: 0;
        }

        .brand-text {
            line-height: 1.15;
        }

        .brand-text .brand-name {
            font-size: 1.15rem;
            font-weight: 800;
            letter-spacing: .6px;
            color: #1c3d5a;
            margin: 0;
        }

        .brand-text .brand-sub {
            font-size: .72rem;
            letter-spacing: 2px;
            text-transform: uppercase;
            color: #8a97a8;
            font-weight: 600;
        }

        /* ============================================================
               HEADINGS
               ============================================================ */
        .login-title {
            font-size: 1.65rem;
            font-weight: 800;
            color: #1c3d5a;
            margin-bottom: 6px;
            letter-spacing: -0.4px;
        }

        .login-subtitle {
            font-size: .92rem;
            color: #7b8798;
            margin-bottom: 26px;
        }

        /* ============================================================
               FORM ELEMENTS
               ============================================================ */
        .form-label {
            font-size: .82rem;
            font-weight: 700;
            color: #46536b;
            letter-spacing: .3px;
            margin-bottom: 7px;
            text-transform: uppercase;
        }

        .input-icon-wrap {
            position: relative;
        }

        .input-icon-wrap>i {
            position: absolute;
            left: 16px;
            top: 50%;
            transform: translateY(-50%);
            font-size: .95rem;
            color: #a6b1c2;
            pointer-events: none;
            transition: color .25s ease;
            z-index: 3;
        }

        .input-icon-wrap .form-control {
            height: 52px;
            padding: 10px 18px 10px 46px;
            border-radius: 12px;
            border: 1.6px solid #e2e7f0;
            background: #f9fbfd;
            font-size: .95rem;
            color: #24344d;
            transition: all .25s ease;
        }

        .input-icon-wrap .form-control::placeholder {
            color: #b3bccb;
        }

        .input-icon-wrap .form-control:focus {
            background: #fff;
            border-color: #f6750f;
            box-shadow: 0 0 0 4px rgba(246, 117, 15, 0.13);
        }

        .input-icon-wrap .form-control:focus~i,
        .input-icon-wrap:focus-within>i {
            color: #f6750f;
        }

        /* password eye button */
        .toggle-password {
            position: absolute;
            right: 10px;
            top: 50%;
            transform: translateY(-50%);
            border: none;
            background: transparent;
            width: 38px;
            height: 38px;
            border-radius: 9px;
            color: #9aa5b8;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all .2s ease;
            z-index: 4;
        }

        .toggle-password:hover {
            background: #f1f4f9;
            color: #f6750f;
        }

        .input-icon-wrap .form-control.has-toggle {
            padding-right: 50px;
        }

        /* error state */
        .form-control.is-invalid {
            border-color: #e24b4b !important;
            background: #fff6f6 !important;
        }

        .form-control.is-invalid:focus {
            box-shadow: 0 0 0 4px rgba(226, 75, 75, .13) !important;
        }

        .invalid-feedback {
            display: block;
            font-size: .8rem;
            color: #e24b4b;
            margin-top: 6px;
            padding-left: 4px;
        }

        /* ============================================================
               REMEMBER / FORGOT ROW
               ============================================================ */
        .options-row {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 10px;
            margin: 18px 0 4px;
            flex-wrap: wrap;
        }

        .form-check-input {
            width: 18px;
            height: 18px;
            margin-top: 1px;
            border: 1.6px solid #cbd3e0;
            border-radius: 5px;
            cursor: pointer;
        }

        .form-check-input:checked {
            background-color: #f6750f;
            border-color: #f6750f;
        }

        .form-check-input:focus {
            box-shadow: 0 0 0 4px rgba(246, 117, 15, .15);
            border-color: #f6750f;
        }

        .form-check-label {
            font-size: .88rem;
            color: #66738a;
            cursor: pointer;
            user-select: none;
            margin-left: 4px;
        }

        .forgot-link {
            font-size: .85rem;
            font-weight: 600;
            color: #f6750f;
            text-decoration: none;
            transition: color .2s ease;
        }

        .forgot-link:hover {
            color: #d3610a;
            text-decoration: underline;
        }

        /* ============================================================
               BUTTON
               ============================================================ */
        .btn-login {
            width: 100%;
            height: 54px;
            margin-top: 20px;
            border: none;
            border-radius: 12px;
            font-size: 1rem;
            font-weight: 700;
            letter-spacing: .6px;
            color: #fff;
            background: linear-gradient(135deg, #f6750f 0%, #ff9a3c 100%);
            box-shadow: 0 12px 26px rgba(246, 117, 15, 0.38);
            transition: all .28s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 9px;
        }

        .btn-login:hover,
        .btn-login:focus {
            color: #fff;
            transform: translateY(-2px);
            box-shadow: 0 18px 34px rgba(246, 117, 15, 0.48);
            background: linear-gradient(135deg, #e86c08 0%, #ff8f2b 100%);
        }

        .btn-login:active {
            transform: translateY(0);
            box-shadow: 0 8px 18px rgba(246, 117, 15, 0.4);
        }

        /* ============================================================
               DIVIDER + REGISTER
               ============================================================ */
        .divider {
            display: flex;
            align-items: center;
            gap: 12px;
            margin: 26px 0 18px;
            color: #aab4c4;
            font-size: .78rem;
            font-weight: 600;
            letter-spacing: 1px;
            text-transform: uppercase;
        }

        .divider::before,
        .divider::after {
            content: "";
            flex: 1;
            height: 1px;
            background: linear-gradient(90deg, transparent, #e2e7f0, transparent);
        }

        .register-text {
            text-align: center;
            font-size: .9rem;
            color: #7b8798;
            margin: 0;
        }

        .register-link {
            color: #f6750f;
            font-weight: 700;
            text-decoration: none;
            transition: color .2s ease;
        }

        .register-link:hover {
            color: #d3610a;
            text-decoration: underline;
        }

        /* secure note */
        .secure-note {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 7px;
            margin-top: 22px;
            font-size: .76rem;
            color: #9aa5b8;
        }

        .secure-note i {
            color: #4caf50;
        }

        /* ============================================================
               ALERTS
               ============================================================ */
        .login-alert {
            border: none;
            border-radius: 12px;
            font-size: .88rem;
            font-weight: 500;
            padding: 13px 16px;
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 18px;
        }

        .login-alert.alert-success {
            background: #e8f8ee;
            color: #1e7a44;
        }

        .login-alert.alert-danger {
            background: #fdecec;
            color: #c22b2b;
        }

        /* ============================================================
               RESPONSIVE
               ============================================================ */
        @media (max-width: 575.98px) {
            .login-wrapper {
                padding: 24px 12px;
            }

            .login-card {
                padding: 34px 24px 28px;
                border-radius: 18px;
            }

            .login-title {
                font-size: 1.4rem;
            }

            .brand-icon {
                width: 46px;
                height: 46px;
                font-size: 1.2rem;
            }
        }
    </style>

    <div class="login-wrapper">
        <!-- Background Image -->
        <div class="login-bg"></div>

        <!-- Gradient Overlay -->
        <div class="login-overlay"></div>

        <!-- Login Card -->
        <div class="login-card">

            <!-- Brand -->
            <div class="brand-wrap">
                <div class="brand-icon">
                    <i class="fas fa-fire-alt"></i>
                </div>
                <div class="brand-text">
                    <p class="brand-name">GAS AGENCY</p>
                    <span class="brand-sub">Management System</span>
                </div>
            </div>

            <h3 class="login-title">Welcome Back</h3>
            <p class="login-subtitle">Sign in to access your dashboard &amp; manage your agency.</p>

            {{-- Success Message --}}
            @if (session('success'))
                <div class="alert alert-success login-alert alert-dismissible fade show" role="alert">
                    <i class="fas fa-check-circle"></i>
                    <span>{{ session('success') }}</span>
                    <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            {{-- Error Message --}}
            @if (session('error'))
                <div class="alert alert-danger login-alert alert-dismissible fade show" role="alert">
                    <i class="fas fa-exclamation-circle"></i>
                    <span>{{ session('error') }}</span>
                    <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}" id="loginForm">
                @csrf

                {{-- Email --}}
                <div class="mb-3">
                    <label for="email" class="form-label">Email Address</label>
                    <div class="input-icon-wrap">
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                            name="email" value="{{ old('email') }}" required autocomplete="email" autofocus
                            placeholder="name@agency.com">
                        <i class="fas fa-envelope"></i>
                    </div>
                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                {{-- Password --}}
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <div class="input-icon-wrap">
                        <input id="password" type="password"
                            class="form-control has-toggle @error('password') is-invalid @enderror" name="password" required
                            autocomplete="current-password" placeholder="••••••••">
                        <i class="fas fa-lock"></i>
                        <button type="button" class="toggle-password" id="togglePassword" aria-label="Show password">
                            <i class="fas fa-eye"></i>
                        </button>
                    </div>
                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                {{-- Remember + Forgot --}}
                <div class="options-row">
                    <div class="form-check d-flex align-items-center">
                        <input class="form-check-input" type="checkbox" name="remember" id="remember"
                            {{ old('remember') ? 'checked' : '' }}>
                        <label class="form-check-label" for="remember">Remember Me</label>
                    </div>

                    @if (Route::has('password.request'))
                        <a class="forgot-link" href="{{ route('password.request') }}">Forgot Password?</a>
                    @endif
                </div>

                {{-- Submit --}}
                <button type="submit" class="btn btn-login" id="loginBtn">
                    <i class="fas fa-sign-in-alt"></i>
                    <span>Sign In</span>
                </button>
            </form>

            {{-- Divider --}}
            <div class="divider">New Here</div>

            {{-- Register --}}
            <p class="register-text">
                Want to register a new agency?
                <a href="{{ route('agency.register') }}" class="register-link">Register Now</a>
            </p>

            {{-- Secure note --}}
            <div class="secure-note">
                <i class="fas fa-shield-alt"></i>
                <span>Your data is protected with secure encryption</span>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function () {

            /* ---------- Show / Hide Password ---------- */
            const toggleBtn = document.getElementById('togglePassword');
            const passwordInput = document.getElementById('password');

            if (toggleBtn && passwordInput) {
                toggleBtn.addEventListener('click', function () {
                    const isPassword = passwordInput.getAttribute('type') === 'password';
                    passwordInput.setAttribute('type', isPassword ? 'text' : 'password');

                    const icon = this.querySelector('i');
                    icon.classList.toggle('fa-eye');
                    icon.classList.toggle('fa-eye-slash');
                    this.setAttribute('aria-label', isPassword ? 'Hide password' : 'Show password');
                });
            }

            /* ---------- Loading state on submit ---------- */
            const form = document.getElementById('loginForm');
            const loginBtn = document.getElementById('loginBtn');

            if (form && loginBtn) {
                form.addEventListener('submit', function () {
                    loginBtn.disabled = true;
                    loginBtn.innerHTML =
                        '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>' +
                        '<span>Signing In...</span>';
                });
            }
        });
    </script>
@endpush