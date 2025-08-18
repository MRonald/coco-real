<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="{{ asset('favicon.png') }}">
    <title>{{ config('app.name', 'xampra') }} | @yield('title')</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Google Fonts -->
    <link
        href="https://fonts.googleapis.com/css2?family=Overpass:ital,wght@0,100;0,200;0,300;0,400;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">

    <!-- Simplebar CSS -->
    <link rel="stylesheet" href="{{ asset('admin/css/simplebar.css') }}">

    <!-- DataTables CSS -->
    <link rel="stylesheet" href="{{ asset('admin/css/dataTables.bootstrap4.css') }}">

    <!-- Date Range Picker CSS -->
    <link rel="stylesheet" href="{{ asset('admin/css/daterangepicker.css') }}">

    <!-- Toastr CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

    <!-- Flatpickr CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">

    <!-- Theme CSS -->
    <link rel="stylesheet" href="{{ asset('admin/css/app-light.css') }}" id="lightTheme">
    <link rel="stylesheet" href="{{ asset('admin/css/app-dark.css') }}" id="darkTheme" disabled>

    <!-- Custom CSS -->
    <style>
        :root {
            --primary: #6366f1;
            --primary-light: #a5b4fc;
            --primary-dark: #4f46e5;
            --secondary: #10b981;
            --danger: #ef4444;
            --warning: #f59e0b;
            --info: #3b82f6;
            --background: #f8fafc;
            --card-bg: #ffffff;
            --text-main: #1e293b;
            --text-light: #64748b;
            --border: #e2e8f0;
            --sidebar-width: 240px;
            --sidebar-collapsed-width: 80px;
            --transition-speed: 0.3s;
        }

        body {
            font-family: 'Overpass', sans-serif;
            background-color: var(--background);
            color: var(--text-main);
            line-height: 1.5;
            overflow-x: hidden;
        }

        .sidebar {
            width: var(--sidebar-width);
            min-height: 100vh;
            background: white;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            transition: all var(--transition-speed);
            position: fixed;
            z-index: 100;
        }

        .sidebar.collapsed {
            width: var(--sidebar-collapsed-width);
        }

        .sidebar.collapsed .nav-link-text {
            display: none;
        }

        .sidebar.collapsed .sidebar-brand {
            font-size: 0;
        }

        .sidebar.collapsed .sidebar-brand::after {
            content: "X";
            font-size: 1.25rem;
        }

        .content-area {
            margin-left: var(--sidebar-width);
            transition: margin-left var(--transition-speed);
            flex: 1;
            padding: 20px;
        }

        .sidebar.collapsed~.content-area {
            margin-left: var(--sidebar-collapsed-width);
        }

        .toggle-btn {
            position: absolute;
            right: -15px;
            top: 10px;
            width: 30px;
            height: 30px;
            border-radius: 50%;
            background: white;
            color: var(--primary);
            border: 2px solid var(--primary);
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            z-index: 101;
        }

        .toggle-btn:hover {
            background: var(--primary);
            color: white;
        }

        .nav-link {
            display: flex;
            align-items: center;
            padding: 10px 15px;
            border-radius: 5px;
            margin-bottom: 5px;
            transition: all 0.2s;
            color: var(--text-main);
            text-decoration: none;
        }

        .nav-link:hover {
            background: rgba(99, 102, 241, 0.1);
        }

        .nav-link.active {
            background: var(--primary);
            color: white;
        }

        .nav-link i {
            margin-right: 10px;
            width: 20px;
            text-align: center;
        }

        .top-navbar {
            background: white;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
            padding: 1rem;
            position: fixed;
            width: 100%;
            z-index: 90;
        }

        .user-avatar {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            background-color: var(--primary-light);
            color: var(--primary-dark);
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 600;
        }

        .dropdown-menu {
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .nav-item {
            margin-right: 10px;
        }

        .nav-item:last-child {
            margin-right: 0;
        }

        @media (max-width: 768px) {
            .sidebar {
                transform: translateX(-100%);
            }

            .sidebar.show {
                transform: translateX(0);
            }

            .sidebar.collapsed {
                width: var(--sidebar-width);
            }

            .content-area {
                margin-left: 0;
            }
        }
    </style>
</head>

<body class="vertical light">
    <div class="app-container">
        <!-- Top Navbar -->
        <nav class="top-navbar">
            <div class="container-fluid d-flex justify-content-between align-items-center">
                <button class="btn d-lg-none" id="mobileSidebarToggle">
                    <i class="fas fa-bars"></i>
                </button>

                <ul class="nav">
                    <li class="nav-item">
                        <a class="nav-link text-muted" href="#" id="modeSwitcher" data-mode="light">
                            <i class="fas fa-sun"></i>
                        </a>
                    </li>
                </ul>

                <ul class="nav ms-auto">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button"
                            data-bs-toggle="dropdown">
                            <div class="user-avatar">
                                <i class="fas fa-user"></i>
                            </div>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end">
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="dropdown-item">
                                    <i class="fas fa-sign-out-alt me-2"></i> Sair
                                </button>
                            </form>
                        </div>
                    </li>
                </ul>
            </div>
        </nav>

        <!-- Sidebar -->
        <div class="sidebar text-white p-3" id="sidebar">
            <button class="toggle-btn" id="toggleSidebar">
                <i class="fas fa-chevron-left"></i>
            </button>

            <div class="logo-container mb-4">
                <h4 class="sidebar-brand text-primary">{{ config('app.name') }}</h4>
            </div>

            <ul class="nav flex-column">
                <li class="nav-item">
                    <a class="nav-link active" href="{{ route('people.index') }}">
                        <i class="fas fa-users"></i>
                        <span class="nav-link-text">People Management</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('users.index') }}">
                        <i class="fas fa-user-cog"></i>
                        <span class="nav-link-text">User Management</span>
                    </a>
                </li>
            </ul>
        </div>

        <!-- Main Content -->
        <main class="content-area" id="mainContent">
            @yield('content')
        </main>
    </div>

    <!-- jQuery -->
    <script src="{{ asset('admin/js/jquery.min.js') }}"></script>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Simplebar JS -->
    <script src="{{ asset('admin/js/simplebar.min.js') }}"></script>

    <!-- Moment JS -->
    <script src="{{ asset('admin/js/moment.min.js') }}"></script>

    <!-- Date Range Picker JS -->
    <script src="{{ asset('admin/js/daterangepicker.js') }}"></script>

    <!-- DataTables JS -->
    <script src="{{ asset('admin/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('admin/js/dataTables.bootstrap4.min.js') }}"></script>

    <!-- Toastr JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    <!-- Input Masks -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/cleave.js@1.6.0"></script>

    <!-- Flatpickr -->
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr/dist/l10n/pt.js"></script>

    <!-- Custom JS -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const sidebar = document.getElementById('sidebar');
            const toggleBtn = document.getElementById('toggleSidebar');
            const mobileToggleBtn = document.getElementById('mobileSidebarToggle');

            const isCollapsed = localStorage.getItem('sidebarCollapsed') === 'true';
            if (isCollapsed) {
                sidebar.classList.add('collapsed');
                toggleBtn.innerHTML = '<i class="fas fa-chevron-right"></i>';
            }

            toggleBtn.addEventListener('click', function() {
                sidebar.classList.toggle('collapsed');
                toggleBtn.innerHTML = sidebar.classList.contains('collapsed') ?
                    '<i class="fas fa-chevron-right"></i>' : '<i class="fas fa-chevron-left"></i>';
                localStorage.setItem('sidebarCollapsed', sidebar.classList.contains('collapsed'));
            });

            mobileToggleBtn.addEventListener('click', function() {
                sidebar.classList.toggle('show');
            });

            const modeSwitcher = document.getElementById('modeSwitcher');
            if (modeSwitcher) {
                modeSwitcher.addEventListener('click', function(e) {
                    e.preventDefault();
                    const lightTheme = document.getElementById('lightTheme');
                    const darkTheme = document.getElementById('darkTheme');

                    if (this.getAttribute('data-mode') === 'light') {
                        this.setAttribute('data-mode', 'dark');
                        this.innerHTML = '<i class="fas fa-moon"></i>';
                        lightTheme.disabled = true;
                        darkTheme.disabled = false;
                    } else {
                        this.setAttribute('data-mode', 'light');
                        this.innerHTML = '<i class="fas fa-sun"></i>';
                        lightTheme.disabled = false;
                        darkTheme.disabled = true;
                    }
                });
            }

            $('.datatable').DataTable({
                autoWidth: true,
                lengthMenu: [
                    [16, 32, 64, -1],
                    [16, 32, 64, "All"]
                ],
                responsive: true
            });

            $('.datepicker').flatpickr({
                dateFormat: "d/m/Y",
                locale: "pt"
            });

            $('.currency-input').each(function() {
                new Cleave(this, {
                    numeral: true,
                    numeralThousandsGroupStyle: 'thousand',
                    numeralDecimalMark: ',',
                    delimiter: '.',
                    prefix: 'R$ ',
                    noImmediatePrefix: true
                });
            });
        });
    </script>

    @stack('scripts')
</body>

</html>
