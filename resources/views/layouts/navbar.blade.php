<style>
    /* ── Modern Top Navbar ── */
    .modern-navbar {
        background: #ffffff !important;
        border-bottom: 1.5px solid #edf2f7;
        padding: 12px 24px;
        min-height: 72px;
        box-shadow: 0 2px 12px rgba(15, 23, 42, 0.03);
    }

    .modern-navbar .btn-sidebar-toggle {
        width: 42px;
        height: 42px;
        border-radius: 12px;
        background: #f1f5f9;
        border: 1px solid #e2e8f0;
        color: #475569;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        font-size: 16px;
        transition: all 0.2s ease;
    }

    .modern-navbar .btn-sidebar-toggle:hover {
        background: #4e7fff;
        color: #ffffff;
        border-color: #4e7fff;
    }

    /* ── Floating Pill Capsule (from image) ── */
    .nav-user-pill-container {
        display: inline-flex;
        align-items: center;
        background: #ffffff;
        border: 1.5px solid #e2e8f0;
        border-radius: 9999px;
        /* full rounded pill */
        padding: 5px 16px 5px 6px;
        box-shadow: 0 3px 15px rgba(30, 41, 59, 0.06);
        gap: 12px;
    }

    /* Language Switcher inside pill */
    .lang-switcher-pill {
        display: inline-flex;
        align-items: center;
        background: #f8fafc;
        border-radius: 9999px;
        padding: 3px;
        gap: 2px;
    }

    .lang-btn {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 6px 14px;
        border-radius: 9999px;
        font-size: 13px;
        font-weight: 700;
        text-decoration: none;
        color: #64748b;
        transition: all 0.2s ease;
    }

    .lang-btn:hover {
        color: #334155;
    }

    .lang-btn.active {
        background: #ede9fe;
        /* soft light purple as in image */
        color: #6366f1;
        /* purple text/icon */
        box-shadow: 0 1px 3px rgba(99, 102, 241, 0.15);
    }

    .lang-btn.active i {
        color: #6366f1;
        font-size: 15px;
    }

    /* Vertical Divider */
    .pill-divider {
        width: 1px;
        height: 28px;
        background: #e2e8f0;
    }

    /* User Profile section */
    .user-profile-trigger {
        display: inline-flex;
        align-items: center;
        gap: 12px;
        background: transparent;
        border: none;
        padding: 2px 4px;
        cursor: pointer;
        text-decoration: none;
        color: inherit;
    }

    .user-profile-trigger:hover,
    .user-profile-trigger:focus {
        outline: none;
        text-decoration: none;
        color: inherit;
    }

    .user-avatar-circle {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        object-fit: cover;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        border: 2px solid #ffffff;
    }

    .user-avatar-initials {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        background: linear-gradient(135deg, #6366f1 0%, #4f46e5 100%);
        color: #ffffff;
        font-weight: 700;
        font-size: 15px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        box-shadow: 0 2px 8px rgba(99, 102, 241, 0.25);
        border: 2px solid #ffffff;
    }

    .user-info-text {
        display: flex;
        flex-direction: column;
        text-align: left;
        line-height: 1.25;
    }

    [dir="rtl"] .user-info-text {
        text-align: right;
    }

    .user-name-label {
        font-size: 14px;
        font-weight: 700;
        color: #1e293b;
    }

    .user-role-label {
        font-size: 12px;
        font-weight: 500;
        color: #94a3b8;
    }

    .user-dropdown-arrow {
        color: #64748b;
        font-size: 12px;
        margin-left: 6px;
        transition: transform 0.2s ease;
    }

    [dir="rtl"] .user-dropdown-arrow {
        margin-left: 0;
        margin-right: 6px;
    }

    .dropdown.show .user-dropdown-arrow {
        transform: rotate(180deg);
    }

    /* Custom Dropdown Menu */
    .modern-dropdown-menu {
        border-radius: 16px;
        border: 1px solid #edf2f7;
        box-shadow: 0 10px 25px rgba(15, 23, 42, 0.1);
        padding: 8px;
        min-width: 200px;
        margin-top: 8px !important;
    }

    .modern-dropdown-menu .dropdown-item {
        border-radius: 10px;
        padding: 9px 14px;
        font-size: 13px;
        font-weight: 600;
        color: #475569;
        display: flex;
        align-items: center;
        gap: 10px;
        transition: all 0.15s ease;
    }

    .modern-dropdown-menu .dropdown-item:hover {
        background: #f1f5f9;
        color: #1e293b;
    }

    .modern-dropdown-menu .dropdown-item.text-danger:hover {
        background: #fee2e2;
        color: #dc2626;
    }

    @media (max-width: 576px) {
        .modern-navbar {
            padding: 8px 12px !important;
            min-height: 60px !important;
        }

        .modern-navbar .btn-sidebar-toggle {
            width: 38px;
            height: 38px;
            border-radius: 10px;
            font-size: 15px;
        }

        .nav-user-pill-container {
            gap: 6px !important;
            padding: 3px 8px 3px 4px !important;
        }

        .lang-switcher-pill {
            padding: 2px !important;
            gap: 2px !important;
        }

        .lang-btn {
            padding: 4px 8px !important;
            font-size: 11px !important;
            gap: 4px !important;
        }

        .user-avatar-initials,
        .user-avatar-circle {
            width: 32px !important;
            height: 32px !important;
            font-size: 13px !important;
        }

        .user-info-text {
            max-width: 80px;
        }

        .user-name-label {
            font-size: 12px !important;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .user-role-label {
            display: none !important;
        }
    }
</style>

<nav class="navbar navbar-expand-lg modern-navbar">
    <div class="container-fluid px-0">
        <!-- Sidebar Toggle Icon Button -->
        <button type="button" class="btn btn-sidebar-toggle" id="sidebarToggle" title="Toggle Sidebar"
            aria-label="Toggle Sidebar">
            <i class="fas fa-bars"></i>
        </button>

        <div class="ms-auto d-flex align-items-center">
            <!-- Floating User & Language Capsule (Same as uploaded design) -->
            <div class="nav-user-pill-container">

                <!-- Language Toggle Buttons -->
                <div class="lang-switcher-pill">
                    <a href="{{ route('lang.switch', 'en') }}"
                        class="lang-btn {{ app()->getLocale() == 'en' ? 'active' : '' }}">
                        <i class="fas fa-globe"></i> English
                    </a>
                    <a href="{{ route('lang.switch', 'ar') }}"
                        class="lang-btn {{ app()->getLocale() == 'ar' ? 'active' : '' }}">
                        Arabic
                    </a>
                </div>

                <!-- Vertical Divider -->
                <div class="pill-divider"></div>

                <!-- User Profile & Dropdown -->
                <div class="dropdown">
                    <a href="#" class="user-profile-trigger dropdown-toggle d-flex align-items-center"
                        id="userMenuDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        @php
                            $user = Auth::user();
                            $roleName = $user && method_exists($user, 'getRoleNames') && $user->getRoleNames()->isNotEmpty()
                                ? $user->getRoleNames()->first()
                                : 'Admin';
                        @endphp

                        {{-- User Avatar --}}
                        <div class="user-avatar-initials">
                            {{ strtoupper(substr($user->name ?? 'A', 0, 1)) }}
                        </div>

                        {{-- Name & Role --}}
                        <div class="user-info-text">
                            <span class="user-name-label">{{ $user->name ?? 'User' }}</span>
                            <span class="user-role-label">{{ $roleName }}</span>
                        </div>


                    </a>

                    <!-- User Menu Popup -->
                    <ul class="dropdown-menu dropdown-menu-end modern-dropdown-menu" aria-labelledby="userMenuDropdown">

                        <li>
                            <a class="dropdown-item" href="{{ route('profile.edit') }}">
                                <i class="fas fa-user-circle text-info"></i> {{ __('messages.profile') }}
                            </a>
                        </li>
                        <li>
                            <hr class="dropdown-divider my-1">
                        </li>
                        <li>
                            <a class="dropdown-item text-danger" href="{{ route('logout') }}"
                                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                <i class="fas fa-sign-out-alt"></i> {{ __('messages.logout') }}
                            </a>
                        </li>
                    </ul>
                </div>

            </div>
        </div>
    </div>
</nav>