<style>
    #sidebarMenu {
        background-color: #0c4c39;
    }
</style>

<div class="d-flex flex-column flex-shrink-0 p-3 text-white" style="width: 280px; min-height: 100vh;">
    <div class="d-flex align-items-center justify-content-between mb-3">
        <a href="/" class="d-flex justify-content-center align-items-center w-100 text-white text-decoration-none">
            @if(Auth::user()->agency?->setting?->logo)
                <img src="{{ asset('storage/' . Auth::user()->agency->setting->logo) }}" alt="Logo" class="img-fluid"
                    style="max-height: 44px; width: auto; padding: 2px;">
            @else
                <span class="fs-4 text-center">
                    {{ config('app.name', 'Gas Agency System') }}
                </span>
            @endif
        </a>
        <button type="button" class="btn btn-sm btn-outline-light d-lg-none" id="sidebarCloseBtn" title="Close Sidebar"
            style="border-radius: 8px; width: 34px; height: 34px; display: inline-flex; align-items: center; justify-content: center; padding: 0;">
            <i class="fas fa-times"></i>
        </button>
    </div>
    <hr class="mt-0">
    <ul class="nav nav-pills flex-column mb-auto">
        @if(auth()->user()->hasRole('Super Admin'))
            <li class="nav-item">
                <a href="{{ route('super_admin.dashboard') }}"
                    class="nav-link text-white {{ request()->routeIs('super_admin.dashboard') ? 'active' : '' }}">
                    <i class="fas fa-tachometer-alt me-2"></i>
                    {{ __('messages.admin_dashboard') }}
                </a>
            </li>
            <li>
                <a href="{{ route('super_admin.agencies.index') }}"
                    class="nav-link text-white {{ request()->routeIs('super_admin.agencies.*') ? 'active' : '' }}">
                    <i class="fas fa-building me-2"></i>
                    {{ __('messages.agencies') }}
                </a>
            </li>
            <li>
                <a href="{{ route('super_admin.requests.index') }}"
                    class="nav-link text-white {{ request()->routeIs('super_admin.requests.*') ? 'active' : '' }}">
                    <i class="fas fa-clipboard-list me-2"></i>
                    {{ __('messages.requests') }}
                </a>
            </li>
        @else
            <li class="nav-item">
                <a href="{{ route('home') }}" class="nav-link text-white {{ request()->routeIs('home') ? 'active' : '' }}">
                    <i class="fas fa-tachometer-alt me-2"></i>
                    {{ __('messages.dashboard') }}
                </a>
            </li>
            @can('customer-list')
                <li>
                    <a href="{{ route('customers.index') }}"
                        class="nav-link text-white {{ request()->routeIs('customers.*') ? 'active' : '' }}">
                        <i class="fas fa-users me-2"></i>
                        {{ __('messages.customers') }}
                    </a>
                </li>
            @endcan
            @can('team-member-list')
                <li>
                    <a href="{{ route('team_members.index') }}"
                        class="nav-link text-white {{ request()->routeIs('team_members.*') ? 'active' : '' }}">
                        <i class="fas fa-user-friends me-2"></i>
                        {{ __('messages.team_members') }}
                    </a>
                </li>
            @endcan
            @can('attendance-list')
                <li>
                    <a href="{{ route('attendances.index') }}"
                        class="nav-link text-white {{ request()->routeIs('attendances.*') ? 'active' : '' }}">
                        <i class="fas fa-calendar-check me-2"></i>
                        {{ __('messages.attendance') }}
                    </a>
                </li>
            @endcan
            @can('inventory-list')
                <li>
                    <a href="{{ route('inventory.index') }}"
                        class="nav-link text-white {{ request()->routeIs('inventory.*') ? 'active' : '' }}">
                        <i class="fas fa-cubes me-2"></i>
                        {{ __('messages.inventory') }}
                    </a>
                </li>
            @endcan
            @can('sale-list')
                <li>
                    <a href="{{ route('sales.index') }}"
                        class="nav-link text-white {{ request()->routeIs('sales.*') ? 'active' : '' }}">
                        <i class="fas fa-shopping-cart me-2"></i>
                        {{ __('messages.sales') }}
                    </a>
                </li>
            @endcan
            @can('expense-list')
                <li>
                    <a href="{{ route('expenses.index') }}"
                        class="nav-link text-white {{ request()->routeIs('expenses.*') ? 'active' : '' }}">
                        <i class="fas fa-receipt me-2"></i>
                        {{ __('messages.expenses') }}
                    </a>
                </li>
            @endcan
            @can('expense-type-list')
                <li>
                    <a href="{{ route('expense_types.index') }}"
                        class="nav-link text-white {{ request()->routeIs('expense_types.*') ? 'active' : '' }}">
                        <i class="fas fa-tags me-2"></i>
                        {{ __('messages.expense_types') }}
                    </a>
                </li>
            @endcan
            @can('salary-list')
                <li>
                    <a href="{{ route('salaries.index') }}"
                        class="nav-link text-white {{ request()->routeIs('salaries.*') ? 'active' : '' }}">
                        <i class="fas fa-money-bill-wave me-2"></i>
                        {{ __('messages.salaries') }}
                    </a>
                </li>
            @endcan
            @can('gas-reading-list')
                <li>
                    <a href="{{ route('gas_readings.index') }}"
                        class="nav-link text-white {{ request()->routeIs('gas_readings.*') ? 'active' : '' }}">
                        <i class="fas fa-burn me-2"></i>
                        {{ __('messages.gas_readings') }}
                    </a>
                </li>
            @endcan
            @can('customer-report-list')
                <li>
                    <a href="{{ route('customer_reports.index') }}"
                        class="nav-link text-white {{ request()->routeIs('customer_reports.*') ? 'active' : '' }}">
                        <i class="fas fa-file-invoice-dollar me-2"></i>
                        {{ __('messages.customer_reports') }}
                    </a>
                </li>
            @endcan
            @can('agency-setting-list')
                <li>
                    <a href="{{ route('agency_settings.index') }}"
                        class="nav-link text-white {{ request()->routeIs('agency_settings.*') ? 'active' : '' }}">
                        <i class="fas fa-cog me-2"></i>
                        {{ __('messages.agency_settings') }}
                    </a>
                </li>
            @endcan
            @can('visa-detail-list')
                <li>
                    <a href="{{ route('visa_details.index') }}"
                        class="nav-link text-white {{ request()->routeIs('visa_details.*') ? 'active' : '' }}">
                        <i class="fas fa-passport me-2"></i>
                        {{ __('messages.visa_details') }}
                    </a>
                </li>
            @endcan
            @can('user-list')
                <li>
                    <a href="{{ route('users.index') }}"
                        class="nav-link text-white {{ request()->routeIs('users.*') ? 'active' : '' }}">
                        <i class="fas fa-user-friends me-2"></i>
                        {{ __('messages.staff_management') }}
                    </a>
                </li>
            @endcan
        @endif
    </ul>
    <hr>
    <div class="dropdown">
        <a href="#" class="d-flex align-items-center text-white text-decoration-none dropdown-toggle" id="dropdownUser1"
            data-bs-toggle="dropdown" aria-expanded="false">
            <img src="https://ui-avatars.com/api/?name={{ Auth::user()->name ?? 'User' }}" alt="" width="32" height="32"
                class="rounded-circle me-2">
            <strong>{{ Auth::user()->name ?? 'Guest' }}</strong>
        </a>
        <ul class="dropdown-menu dropdown-menu-dark text-small shadow" aria-labelledby="dropdownUser1">
            <li><a class="dropdown-item" href="{{ route('profile.edit') }}">{{ __('messages.profile') }}</a></li>
            <li>
                <hr class="dropdown-divider">
            </li>
            <li>
                <a class="dropdown-item" href="{{ route('logout') }}"
                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    {{ __('messages.logout') }}
                </a>
            </li>
        </ul>
    </div>
</div>