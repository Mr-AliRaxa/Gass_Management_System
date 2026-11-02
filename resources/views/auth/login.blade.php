@extends('layouts.app')

@section('content')
    <style>
        /* Full screen override for login page */
        #page-content-wrapper {
            padding: 0 !important;
        }

        main.container-fluid {
            padding: 0 !important;
            max-width: 100% !important;
        }

        .login-container {
            display: flex;
            min-height: 100vh;
            width: 100%;
            background: #f8f9fc;
        }

        .login-image-side {
            flex: 1.2;
            background: url('{{ asset('images/login-bg.png') }}') no-repeat center center;
            background-size: cover;
            position: relative;
            display: none;
        }

        @media (min-width: 992px) {
            .login-image-side {
                display: block;
            }
        }

        .login-image-overlay {
            position: absolute;
            inset: 0;
            background: linear-gradient(135deg, rgba(28, 61, 90, 0.7), rgba(246, 117, 15, 0.4));
            display: flex;
            flex-direction: column;
            justify-content: center;
            padding: 60px;
            color: white;
        }

        .login-form-side {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 40px;
            background: #fff;
        }

        .login-box {
            width: 100%;
            max-width: 400px;
            animation: fadeIn 0.8s ease-out;
        }

        .brand-logo {
            color: #f6750f;
            font-size: 2.5rem;
            font-weight: 800;
            margin-bottom: 30px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .form-control {
            height: 50px;
            border-radius: 8px;
            border: 1px solid #e3e6f0;
            padding: 10px 20px;
            font-size: 1rem;
            transition: all 0.3s;
        }

        .form-control:focus {
            border-color: #f6750f;
            box-shadow: 0 0 0 0.2rem rgba(246, 117, 15, 0.15);
        }

        .btn-login {
            height: 50px;
            background: #f6750f;
            border: none;
            border-radius: 8px;
            font-weight: 700;
            font-size: 1.1rem;
            color: white;
            transition: all 0.3s;
            width: 100%;
            margin-top: 20px;
        }

        .btn-login:hover {
            background: #e56b0d;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(246, 117, 15, 0.3);
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .agency-motto {
            font-size: 1.2rem;
            opacity: 0.9;
            margin-top: 10px;
        }
    </style>

    <div class="login-container">
        <!-- Left Side: Image -->
        <div class="login-image-side">
            <div class="login-image-overlay">
                <h1 class="display-4 font-weight-bold">GAS AGENCY MANAGEMENT SYSTEM</h1>
                <p class="agency-motto">Fuelling your life with safety and efficiency. Authorized Gas Agency Management
                    System.</p>
            </div>
        </div>

        <!-- Right Side: Form -->
        <div class="login-form-side">
            <div class="login-box">
                <div class="brand-logo">
                    <i class="fas fa-fire-alt"></i>
                    <span>GAS AGENCY</span>
                </div>

                <h3 class="font-weight-bold mb-4">Welcome Back</h3>
                <p class="text-muted mb-4">Please enter your credentials to access the dashboard.</p>

                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <i class="fas fa-check-circle me-2"></i>
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                @if (session('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <i class="fas fa-exclamation-circle me-2"></i>
                        {{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <div class="mb-3">
                        <label for="email" class="form-label font-weight-bold">Email Address</label>
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                            name="email" value="{{ old('email') }}" required autocomplete="email" autofocus
                            placeholder="name@agency.com">
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label font-weight-bold">Password</label>
                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                            name="password" required autocomplete="current-password" placeholder="••••••••">
                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                            <label class="form-check-label text-muted" for="remember">
                                Remember Me
                            </label>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-login">
                        Sign In
                    </button>

                    <div class="text-center mt-4">
                        <p class="text-muted">Want to register a new agency?
                            <a href="{{ route('agency.register') }}" class="text-primary fw-bold">Register Now</a>
                        </p>
                    </div>

                    @if (Route::has('password.request'))
                        <div class="text-center mt-4">
                            <a class="btn btn-link text-muted" href="{{ route('password.request') }}">
                                Forgot Your Password?
                            </a>
                        </div>
                    @endif
                </form>
            </div>
        </div>
    </div>
@endsection