<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" @if(app()->getLocale() == 'ar') dir="rtl" @endif>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    @if(app()->getLocale() == 'ar')
        <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;600;700;800&display=swap" rel="stylesheet">
        <style>
            body, h1, h2, h3, h4, h5, h6, .nav-link, .dropdown-item, .card-title, .table, button, input, select, textarea {
                font-family: 'Cairo', sans-serif !important;
            }
            [dir="rtl"] {
                text-align: right;
            }
            [dir="rtl"] .ms-auto {
                margin-right: auto !important;
                margin-left: 0 !important;
            }
            [dir="rtl"] .me-auto {
                margin-left: auto !important;
                margin-right: 0 !important;
            }
            [dir="rtl"] .me-1, [dir="rtl"] .me-2, [dir="rtl"] .me-3 {
                margin-right: 0 !important;
            }
            [dir="rtl"] .me-1 { margin-left: 0.25rem !important; }
            [dir="rtl"] .me-2 { margin-left: 0.5rem !important; }
            [dir="rtl"] .me-3 { margin-left: 1rem !important; }

            [dir="rtl"] .ms-1, [dir="rtl"] .ms-2, [dir="rtl"] .ms-3 {
                margin-left: 0 !important;
            }
            [dir="rtl"] .ms-1 { margin-right: 0.25rem !important; }
            [dir="rtl"] .ms-2 { margin-right: 0.5rem !important; }
            [dir="rtl"] .ms-3 { margin-right: 1rem !important; }

            [dir="rtl"] .text-end {
                text-align: left !important;
            }
            [dir="rtl"] .text-start {
                text-align: right !important;
            }
            [dir="rtl"] .dropdown-menu-end {
                right: auto !important;
                left: 0 !important;
            }
        </style>
    @else
        <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    @endif
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    
    <style>
        body {
            overflow-x: hidden;
        }
        #wrapper {
            display: flex;
            width: 100%;
            min-height: 100vh;
            position: relative;
        }
        #page-content-wrapper {
            flex-grow: 1;
            min-width: 0;
            width: 100%;
            transition: all 0.3s ease;
        }

        /* Sidebar overlay */
        .sidebar-overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            width: 100%;
            height: 100%;
            background: rgba(15, 23, 42, 0.65);
            backdrop-filter: blur(3px);
            -webkit-backdrop-filter: blur(3px);
            z-index: 1040;
            opacity: 0;
            transition: opacity 0.3s ease;
            cursor: pointer;
        }
        .sidebar-overlay.show {
            display: block;
            opacity: 1;
        }

        /* Desktop layout (992px and up) */
        @media (min-width: 992px) {
            #sidebarMenu {
                width: 280px;
                flex-shrink: 0;
                min-height: 100vh;
                background: #212529;
            }
            #page-content-wrapper {
                width: calc(100% - 280px);
            }
            .sidebar-overlay {
                display: none !important;
            }
        }

        /* Mobile & Tablet layout (below 992px) */
        @media (max-width: 991.98px) {
            #sidebarMenu {
                position: fixed !important;
                top: 0 !important;
                left: 0 !important;
                bottom: 0 !important;
                width: 280px !important;
                max-width: 85vw !important;
                height: 100vh !important;
                min-height: 100vh !important;
                z-index: 1050 !important;
                transform: translateX(-100%) !important;
                transition: transform 0.3s cubic-bezier(0.4, 0, 0.2, 1) !important;
                overflow-y: auto !important;
                -webkit-overflow-scrolling: touch !important;
                box-shadow: none;
                background: #212529 !important;
            }
            #sidebarMenu.show {
                transform: translateX(0) !important;
                box-shadow: 4px 0 24px rgba(0, 0, 0, 0.4) !important;
            }
            [dir="rtl"] #sidebarMenu {
                left: auto !important;
                right: 0 !important;
                transform: translateX(100%) !important;
            }
            [dir="rtl"] #sidebarMenu.show {
                transform: translateX(0) !important;
                box-shadow: -4px 0 24px rgba(0, 0, 0, 0.4) !important;
            }
            #page-content-wrapper {
                width: 100% !important;
            }
            body.sidebar-open {
                overflow: hidden !important;
            }
        }

        #sidebarMenu > div {
            width: 100% !important;
            max-width: 100% !important;
            min-height: 100vh !important;
        }

        /* ══════════════════════════════════════════════════
           GLOBAL MODERN PAGINATION
        ══════════════════════════════════════════════════ */
        .pagination-wrap {
            padding: 14px 24px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 14px;
            background: #ffffff;
            border-top: 1.5px solid #f1f5f9;
        }
        .pagination-wrap > nav,
        .pagination-container {
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 12px;
            flex: 1 1 auto;
            min-width: 0;
            width: 100%;
        }
        .pagination-wrap .pagination-info,
        .pagination-container .pagination-info {
            font-size: 13px;
            color: #64748b;
            font-weight: 500;
        }
        .pagination-wrap .pagination-info span,
        .pagination-container .pagination-info span {
            color: #1e293b;
            font-weight: 700;
        }
        ul.pagination.pagination-modern,
        .pagination-wrap ul.pagination {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            margin: 0;
            padding: 0;
            list-style: none;
        }
        ul.pagination.pagination-modern .page-item .page-link,
        .pagination-wrap .page-item .page-link {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-width: 36px;
            height: 36px;
            padding: 0 10px;
            font-size: 13px;
            font-weight: 600;
            color: #475569;
            background: #ffffff;
            border: 1.5px solid #e2e8f0;
            border-radius: 8px !important;
            text-decoration: none;
            transition: all 0.15s ease-in-out;
            box-shadow: 0 1px 2px rgba(0, 0, 0, 0.03);
        }
        ul.pagination.pagination-modern .page-item .page-link:hover,
        .pagination-wrap .page-item .page-link:hover {
            color: #2563eb;
            background: #eff6ff;
            border-color: #93c5fd;
            transform: translateY(-1px);
        }
        ul.pagination.pagination-modern .page-item.active .page-link,
        .pagination-wrap .page-item.active .page-link {
            color: #ffffff !important;
            background: linear-gradient(135deg, #2563eb 0%, #1d4ed8 100%) !important;
            border-color: #2563eb !important;
            font-weight: 700;
            box-shadow: 0 2px 8px rgba(37, 99, 235, 0.35) !important;
        }
        ul.pagination.pagination-modern .page-item.disabled .page-link,
        .pagination-wrap .page-item.disabled .page-link {
            color: #cbd5e1 !important;
            background: #f8fafc !important;
            border-color: #e2e8f0 !important;
            cursor: not-allowed;
            pointer-events: none;
            box-shadow: none;
            opacity: 0.7;
        }
        ul.pagination.pagination-modern .page-item.disabled .page-link.dots,
        .pagination-wrap .page-item.disabled .page-link.dots {
            border: none;
            background: transparent !important;
            color: #94a3b8 !important;
        }
        .pagination-wrap .show-entries {
            font-size: 13px;
            color: #64748b;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            font-weight: 500;
        }
        .pagination-wrap .entries-select {
            border: 1.5px solid #e2e8f0;
            border-radius: 8px;
            padding: 4px 8px;
            font-size: 13px;
            color: #334155;
            background: #ffffff;
            font-weight: 600;
            outline: none;
        }
        .pagination-wrap .entries-select:focus {
            border-color: #2563eb;
            box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.1);
        }
        /* Defend against unstyled giant SVGs */
        .pagination-wrap svg,
        nav[role="navigation"] svg {
            width: 14px !important;
            height: 14px !important;
            max-width: 14px !important;
            max-height: 14px !important;
            display: inline-block !important;
            vertical-align: middle;
        }
    </style>
    @stack('styles')
</head>
<body>
    <div id="wrapper">
        <!-- Sidebar -->
        @auth
            <div id="sidebarMenu" class="sidebar">
                @include('layouts.sidebar')
            </div>
            <div class="sidebar-overlay" id="sidebarOverlay"></div>
        @endauth

        <!-- Page Content -->
        <div id="page-content-wrapper">
            @auth
                @include('layouts.navbar')
            @endauth

            <main class="container-fluid p-3 p-md-4">
                @yield('content')
            </main>
        </div>
    </div>
    
    <!-- Global Delete Confirmation Modal -->
    <div class="modal fade" id="deleteModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 shadow-lg">
                <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title" id="deleteModalLabel text-white">
                        <i class="fas fa-exclamation-triangle me-2"></i> {{ __('messages.confirm_delete_title') }}
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-4 text-center">
                    <div class="mb-3">
                        <i class="fas fa-trash-alt fa-3x text-danger opacity-25"></i>
                    </div>
                    <h5 class="font-weight-bold mb-2">{{ __('messages.confirm_delete_msg') }}</h5>
                </div>
                <div class="modal-footer border-0 bg-light justify-content-center">
                    <button type="button" class="btn btn-outline-secondary px-4" data-bs-dismiss="modal">{{ __('messages.cancel') }}</button>
                    <form id="global-delete-form" method="POST" style="display:inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger px-4 shadow-sm font-weight-bold">{{ __('messages.delete') }}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
        @csrf
    </form>

    <script>
        function confirmDelete(url) {
            const form = document.getElementById('global-delete-form');
            form.setAttribute('action', url);
            const deleteModal = new bootstrap.Modal(document.getElementById('deleteModal'));
            deleteModal.show();
        }
    </script>
    <!-- Mobile Sidebar Interaction Script -->
    <script>
        (function() {
            function setupSidebar() {
                var sidebar = document.getElementById('sidebarMenu');
                var overlay = document.getElementById('sidebarOverlay');

                function openSidebar() {
                    if (sidebar) sidebar.classList.add('show');
                    if (overlay) overlay.classList.add('show');
                    document.body.classList.add('sidebar-open');
                }

                function closeSidebar() {
                    if (sidebar) sidebar.classList.remove('show');
                    if (overlay) overlay.classList.remove('show');
                    document.body.classList.remove('sidebar-open');
                }

                function toggleSidebar() {
                    if (sidebar && sidebar.classList.contains('show')) {
                        closeSidebar();
                    } else {
                        openSidebar();
                    }
                }

                // Global click delegation for all buttons that toggle sidebar
                document.addEventListener('click', function(e) {
                    var toggleBtn = e.target.closest('#sidebarToggle, .btn-sidebar-toggle');
                    if (toggleBtn) {
                        e.preventDefault();
                        e.stopPropagation();
                        toggleSidebar();
                        return;
                    }

                    var closeBtn = e.target.closest('#sidebarCloseBtn, .sidebar-close-btn');
                    if (closeBtn) {
                        e.preventDefault();
                        closeSidebar();
                        return;
                    }

                    if (e.target === overlay) {
                        closeSidebar();
                        return;
                    }

                    // Auto-close when clicking any link inside sidebar
                    if (sidebar && sidebar.contains(e.target)) {
                        var link = e.target.closest('a');
                        if (link && !link.classList.contains('dropdown-toggle')) {
                            var href = link.getAttribute('href');
                            if (href && href !== '#' && !href.startsWith('javascript:')) {
                                closeSidebar();
                            }
                        }
                    }
                });

                // ESC key closes sidebar
                document.addEventListener('keydown', function(e) {
                    if (e.key === 'Escape' || e.keyCode === 27) {
                        closeSidebar();
                    }
                });

                // Close sidebar on desktop resize
                window.addEventListener('resize', function() {
                    if (window.innerWidth >= 992) {
                        closeSidebar();
                    }
                });
            }

            if (document.readyState === 'loading') {
                document.addEventListener('DOMContentLoaded', setupSidebar);
            } else {
                setupSidebar();
            }
        })();
    </script>

    @stack('scripts')
</body>
</html>
