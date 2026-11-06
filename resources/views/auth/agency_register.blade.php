@extends('layouts.app')

@section('content')
    <style>
        :root {
            --amber: #f59e0b;
            --orange: #ea580c;
            --amber-lt: #fbbf24;
            --navy: #0a0e17;
            --ink: #0f172a;
            --muted: #64748b;
            --line: #e2e8f0;
        }

        /* ===================================================
                               PAGE SHELL — locked to viewport, NO full-page scroll
                               =================================================== */


        .reg-shell::after {
            content: "";
            position: absolute;
            inset: 0;
            background:
                radial-gradient(circle at 18% 30%, rgba(245, 158, 11, .22), transparent 50%),
                radial-gradient(circle at 82% 75%, rgba(234, 88, 12, .16), transparent 55%),
                linear-gradient(135deg, rgba(10, 14, 23, .95), rgba(10, 14, 23, .82));
        }

        /* Grid — left brand | right form */
        .reg-grid {
            position: relative;
            z-index: 2;
            height: 100%;
            display: grid;
            grid-template-columns: 1.05fr 1fr;
            align-items: center;
            gap: 50px;
            padding: 34px 56px;
            max-width: 1480px;
            margin: 0 auto;
        }

        /* ===================================================
                               LEFT — Branding panel
                               =================================================== */
        .brand-side {
            position: relative;
            color: #fff;
            max-width: 540px;
            padding-right: 20px;
        }

        .brand-side::before {
            /* soft amber glow behind text */
            content: "";
            position: absolute;
            width: 420px;
            height: 420px;
            top: -90px;
            left: -110px;
            border-radius: 50%;
            background: radial-gradient(circle, rgba(245, 158, 11, .22), transparent 65%);
            filter: blur(45px);
            pointer-events: none;
            z-index: -1;
        }

        .brand-badge {
            display: inline-flex;
            align-items: center;
            gap: 9px;
            padding: 8px 17px;
            border-radius: 999px;
            background: rgba(245, 158, 11, .13);
            border: 1px solid rgba(245, 158, 11, .34);
            backdrop-filter: blur(10px);
            font-size: .74rem;
            font-weight: 700;
            letter-spacing: .9px;
            text-transform: uppercase;
            color: var(--amber-lt);
            margin-bottom: 22px;
        }

        .brand-badge i {
            font-size: .85rem;
        }

        .brand-side h1 {
            font-size: 2.85rem;
            font-weight: 800;
            line-height: 1.12;
            letter-spacing: -1px;
            margin: 0 0 16px;
        }

        .brand-side h1 span {
            background: linear-gradient(120deg, var(--amber-lt), var(--orange));
            -webkit-background-clip: text;
            background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .brand-sub {
            font-size: .98rem;
            line-height: 1.65;
            color: rgba(255, 255, 255, .74);
            max-width: 440px;
            margin: 0 0 26px;
        }

        /* Feature list */
        .feature-list {
            list-style: none;
            padding: 0;
            margin: 0 0 30px;
        }

        .feature-list li {
            display: flex;
            align-items: center;
            gap: 11px;
            color: rgba(255, 255, 255, .86);
            font-size: .92rem;
            padding: 7px 0;
        }

        .feature-list .fi {
            width: 26px;
            height: 26px;
            flex: 0 0 26px;
            display: grid;
            place-items: center;
            border-radius: 8px;
            background: rgba(245, 158, 11, .16);
            color: var(--amber-lt);
            font-size: .72rem;
        }

        /* Stats */
        .stats-row {
            display: flex;
            gap: 34px;
            padding-top: 22px;
            border-top: 1px solid rgba(255, 255, 255, .13);
        }

        .stats-row .stat strong {
            display: block;
            font-size: 1.4rem;
            font-weight: 800;
            line-height: 1;
            margin-bottom: 5px;
        }

        .stats-row .stat small {
            color: rgba(255, 255, 255, .58);
            font-size: .72rem;
            letter-spacing: .5px;
            text-transform: uppercase;
        }

        /* ===================================================
                               RIGHT — Form card (scrolls internally if needed)
                               =================================================== */
        .form-side {
            display: flex;
            justify-content: center;
            min-height: 0;
            /* allow child shrink */
        }

        .form-card {
            width: 100%;
            max-width: 500px;
            max-height: calc(100vh - 68px);
            background: #fff;
            border-radius: 22px;
            overflow: hidden;
            display: flex;
            flex-direction: column;
            box-shadow:
                0 30px 70px -20px rgba(0, 0, 0, .65),
                0 0 0 1px rgba(255, 255, 255, .06);
            animation: cardIn .5s cubic-bezier(.22, .8, .3, 1) both;
        }

        @keyframes cardIn {
            from {
                opacity: 0;
                transform: translateY(22px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Card header */
        .form-card-head {
            position: relative;
            display: flex;
            align-items: center;
            gap: 13px;
            padding: 22px 26px;
            background: linear-gradient(135deg, var(--amber) 0%, var(--orange) 100%);
            color: #fff;
            overflow: hidden;
            flex-shrink: 0;
        }

        .form-card-head::after {
            content: "";
            position: absolute;
            width: 180px;
            height: 180px;
            border-radius: 50%;
            background: rgba(255, 255, 255, .12);
            top: -95px;
            right: -50px;
        }

        .form-card-head::before {
            content: "";
            position: absolute;
            width: 110px;
            height: 110px;
            border-radius: 50%;
            background: rgba(255, 255, 255, .08);
            bottom: -65px;
            left: -30px;
        }

        .form-head-icon {
            width: 46px;
            height: 46px;
            flex: 0 0 46px;
            display: grid;
            place-items: center;
            border-radius: 13px;
            background: rgba(255, 255, 255, .18);
            border: 1px solid rgba(255, 255, 255, .30);
            font-size: 1.15rem;
            position: relative;
            z-index: 1;
        }

        .form-card-head h3 {
            font-size: 1.1rem;
            font-weight: 700;
            margin: 0 0 3px;
            letter-spacing: -.2px;
            position: relative;
            z-index: 1;
        }

        .form-card-head p {
            margin: 0;
            font-size: .8rem;
            color: rgba(255, 255, 255, .88);
            position: relative;
            z-index: 1;
        }

        /* Scrollable body */
        .form-card-body {
            padding: 22px 26px 20px;
            overflow-y: auto;
            flex: 1;
            min-height: 0;
        }

        .form-card-body::-webkit-scrollbar {
            width: 6px;
        }

        .form-card-body::-webkit-scrollbar-track {
            background: transparent;
        }

        .form-card-body::-webkit-scrollbar-thumb {
            background: #cbd5e1;
            border-radius: 3px;
        }

        .form-card-body::-webkit-scrollbar-thumb:hover {
            background: #94a3b8;
        }

        /* Section labels */
        .section-label {
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: .7rem;
            font-weight: 700;
            color: var(--orange);
            text-transform: uppercase;
            letter-spacing: .9px;
            margin: 4px 0 11px;
        }

        .section-label i {
            font-size: .78rem;
        }

        .section-label.second {
            margin-top: 16px;
        }

        /* Fields */
        .field {
            margin-bottom: 13px;
        }

        .field label {
            display: block;
            font-size: .77rem;
            font-weight: 600;
            color: #334155;
            margin-bottom: 5px;
            letter-spacing: .2px;
        }

        .field label .req {
            color: #ef4444;
        }

        .field label .opt {
            color: #94a3b8;
            font-weight: 500;
            font-size: .72rem;
        }

        .field input,
        .field textarea {
            width: 100%;
            padding: 10px 13px;
            border: 1.5px solid var(--line);
            border-radius: 10px;
            background: #f8fafc;
            font-size: .89rem;
            font-family: inherit;
            color: var(--ink);
            transition: border-color .16s, box-shadow .16s, background .16s;
            resize: none;
        }

        .field input:focus,
        .field textarea:focus {
            outline: none;
            border-color: var(--amber);
            background: #fff;
            box-shadow: 0 0 0 3px rgba(245, 158, 11, .15);
        }

        .field input.is-invalid,
        .field textarea.is-invalid {
            border-color: #ef4444;
            background: #fef2f2;
        }

        .field .err {
            color: #dc2626;
            font-size: .74rem;
            margin-top: 4px;
            padding-left: 2px;
        }

        .field-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 11px;
        }

        .field-row .field {
            margin-bottom: 13px;
        }

        /* Submit */
        .btn-submit {
            width: 100%;
            border: 0;
            border-radius: 11px;
            padding: 12px;
            margin-top: 4px;
            font-size: .93rem;
            font-weight: 700;
            letter-spacing: .3px;
            color: #fff;
            background: linear-gradient(135deg, var(--amber) 0%, var(--orange) 100%);
            box-shadow: 0 10px 22px -8px rgba(234, 88, 12, .68);
            cursor: pointer;
            transition: transform .15s, box-shadow .15s, filter .15s;
        }

        .btn-submit:hover {
            transform: translateY(-1px);
            filter: brightness(1.06);
            box-shadow: 0 14px 28px -10px rgba(234, 88, 12, .78);
        }

        .btn-submit:active {
            transform: translateY(0);
        }

        /* Card footer */
        .form-foot {
            text-align: center;
            padding: 13px 26px 16px;
            border-top: 1px solid var(--line);
            background: #fff;
            font-size: .8rem;
            color: var(--muted);
            flex-shrink: 0;
        }

        .form-foot a {
            color: var(--orange);
            font-weight: 700;
            text-decoration: none;
        }

        .form-foot a:hover {
            text-decoration: underline;
        }

        /* ===================================================
                               RESPONSIVE
                               =================================================== */
        @media (max-width: 991.98px) {
            .reg-shell {
                height: auto;
                min-height: 100vh;
                overflow: auto;
            }

            .reg-grid {
                grid-template-columns: 1fr;
                padding: 30px 22px;
                gap: 26px;
                height: auto;
            }

            .brand-side {
                max-width: 100%;
                padding-right: 0;
            }

            .brand-side h1 {
                font-size: 2rem;
            }

            .brand-sub {
                font-size: .9rem;
            }

            .form-card {
                max-height: none;
            }
        }

        @media (max-width: 575.98px) {
            .field-row {
                grid-template-columns: 1fr;
            }

            .form-card-head {
                padding: 18px 20px;
            }

            .form-card-body {
                padding: 18px 20px;
            }

            .stats-row {
                gap: 22px;
            }

            .brand-side h1 {
                font-size: 1.7rem;
            }
        }
    </style>

    {{-- =============================================================== --}}
    <div class="reg-shell">
        <div class="reg-grid">

            {{-- ─────────── LEFT : Branding ─────────── --}}
            <aside class="brand-side">

                <div class="brand-badge">
                    <i class="fas fa-fire-flame-curved"></i> Gas Agency Platform
                </div>

                <h1>Run Your <span>Gas Agency</span><br>Smarter.</h1>

                <p class="brand-sub">
                    Register your agency, track cylinders, manage deliveries and grow
                    your business — all from one powerful dashboard.
                </p>

                <ul class="feature-list">
                    <li><span class="fi"><i class="fas fa-circle-check"></i></span> Cylinder stock &amp; inventory tracking
                    </li>
                    <li><span class="fi"><i class="fas fa-circle-check"></i></span> Customer, booking &amp; delivery
                        management</li>
                    <li><span class="fi"><i class="fas fa-circle-check"></i></span> Invoices, reports &amp; staff accounts
                    </li>
                    <li><span class="fi"><i class="fas fa-circle-check"></i></span> Secure cloud access from any device</li>
                </ul>

                <div class="stats-row">
                    <div class="stat"><strong>500+</strong><small>Agencies</small></div>
                    <div class="stat"><strong>50K+</strong><small>Cylinders</small></div>
                    <div class="stat"><strong>99.9%</strong><small>Uptime</small></div>
                </div>

            </aside>

            {{-- ─────────── RIGHT : Registration Form ─────────── --}}
            <main class="form-side">
                <div class="form-card">

                    {{-- Header --}}
                    <div class="form-card-head">
                        <div class="form-head-icon">
                            <i class="fas fa-fire-flame-curved"></i>
                        </div>
                        <div>
                            <h3>Register Your Gas Agency</h3>
                            <p>Fill the form — our team will verify &amp; activate your account.</p>
                        </div>
                    </div>

                    {{-- Form body (scrolls internally only if needed) --}}
                    <div class="form-card-body">
                        <form method="POST" action="{{ route('agency.register.submit') }}">
                            @csrf

                            {{-- Agency info --}}
                            <div class="section-label"><i class="fas fa-building"></i> Agency Information</div>

                            <div class="field">
                                <label>Agency Name <span class="req">*</span></label>
                                <input id="agency_name" type="text" name="agency_name" value="{{ old('agency_name') }}"
                                    class="@error('agency_name') is-invalid @enderror" required
                                    placeholder="e.g. Muscat Gas Agency">
                                @error('agency_name')
                                <div class="err">{{ $message }}</div>@enderror
                            </div>

                            <div class="field">
                                <label>Location / Address <span class="req">*</span></label>
                                <input id="location" type="text" name="location" value="{{ old('location') }}"
                                    class="@error('location') is-invalid @enderror" required
                                    placeholder="Street, Area, City">
                                @error('location')
                                <div class="err">{{ $message }}</div>@enderror
                            </div>

                            {{-- Owner info --}}
                            <div class="section-label second"><i class="fas fa-user-tie"></i> Owner Information</div>

                            <div class="field-row">
                                <div class="field">
                                    <label>Owner Name <span class="req">*</span></label>
                                    <input id="owner_name" type="text" name="owner_name" value="{{ old('owner_name') }}"
                                        class="@error('owner_name') is-invalid @enderror" required placeholder="Full name">
                                    @error('owner_name')
                                    <div class="err">{{ $message }}</div>@enderror
                                </div>
                                <div class="field">
                                    <label>Phone <span class="req">*</span></label>
                                    <input id="phone" type="text" name="phone" value="{{ old('phone') }}"
                                        class="@error('phone') is-invalid @enderror" required placeholder="03XX-XXXXXXX">
                                    @error('phone')
                                    <div class="err">{{ $message }}</div>@enderror
                                </div>
                            </div>

                            <div class="field">
                                <label>Business Email <span class="req">*</span></label>
                                <input id="email" type="email" name="email" value="{{ old('email') }}"
                                    class="@error('email') is-invalid @enderror" required placeholder="you@agency.com">
                                @error('email')
                                <div class="err">{{ $message }}</div>@enderror
                            </div>

                            <div class="field">
                                <label>Additional Notes <span class="opt">(optional)</span></label>
                                <textarea id="note" name="note" rows="2"
                                    placeholder="Anything we should know?">{{ old('note') }}</textarea>
                            </div>

                            <button type="submit" class="btn-submit">
                                <i class="fas fa-paper-plane me-1"></i> Submit Registration Request
                            </button>
                        </form>
                    </div>

                    {{-- Footer --}}
                    <div class="form-foot">
                        Already have an approved agency?
                        <a href="{{ route('login') }}">Login Here</a>
                    </div>

                </div>
            </main>

        </div>
    </div>
@endsection