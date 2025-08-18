<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
{{-- TESTE-APP-TESTE --}}{{-- TESTE-APP-TESTE --}}{{-- TESTE-APP-TESTE --}}

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'xampra') }} | @yield('title')</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        :root {
            --primary: #3498db;
            --secondary: #2ecc71;
            --dark: #2c3e50;
            --light: #ecf0f1;
        }

        .sidebar {
            width: 250px;
            min-height: 100vh;
            background: var(--dark);
            transition: all 0.3s ease;
            position: relative;
        }

        .sidebar.collapsed {
            width: 60px;
            overflow: hidden;
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
            flex: 1;
            padding: 20px;
            transition: all 0.3s ease;
        }

        .toggle-btn {
            position: absolute;
            right: -15px;
            top: 10px;
            width: 30px;
            height: 30px;
            border-radius: 50%;
            background: var(--dark);
            color: white;
            border: 2px solid white;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            z-index: 100;
        }

        .toggle-btn:hover {
            background: var(--primary);
        }

        .person-card {
            transition: transform 0.2s;
        }

        .person-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
        }

        .nav-link {
            display: flex;
            align-items: center;
            padding: 10px 15px;
            border-radius: 5px;
            margin-bottom: 5px;
            transition: all 0.2s;
        }

        .nav-link:hover {
            background: rgba(255, 255, 255, 0.1);
        }

        .nav-link.active {
            background: var(--primary);
        }

        .nav-link i {
            margin-right: 10px;
            width: 20px;
            text-align: center;
        }
    </style>
</head>

<body>
    <div class="d-flex">
        <!-- Sidebar -->
        <div class="sidebar text-white p-3" id="sidebar">
            <button class="toggle-btn" id="toggleSidebar">
                <i class="fas fa-chevron-left"></i>
            </button>

            <h4 class="mb-4 sidebar-brand">{{ config('app.name') }}</h4>

            <ul class="nav flex-column">
                <li class="nav-item">
                    <a class="nav-link text-white active" href="{{ route('people.index') }}">
                        <i class="fas fa-users"></i>
                        <span class="nav-link-text">People Management</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white" href="{{ route('users.index') }}">
                        <i class="fas fa-user-cog"></i>
                        <span class="nav-link-text">User Management</span>
                    </a>
                </li>
                <!-- Adicione mais itens de menu conforme necessário -->
            </ul>
        </div>

        <!-- Main Content -->
        <div class="content-area" id="mainContent">
            @yield('content')
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const sidebar = document.getElementById('sidebar');
            const toggleBtn = document.getElementById('toggleSidebar');
            const mainContent = document.getElementById('mainContent');

            // Verifica se há um estado salvo no localStorage
            const isCollapsed = localStorage.getItem('sidebarCollapsed') === 'true';
            if (isCollapsed) {
                sidebar.classList.add('collapsed');
                toggleBtn.innerHTML = '<i class="fas fa-chevron-right"></i>';
            }

            // Adiciona o evento de clique no botão de toggle
            toggleBtn.addEventListener('click', function() {
                sidebar.classList.toggle('collapsed');

                // Altera o ícone do botão
                if (sidebar.classList.contains('collapsed')) {
                    toggleBtn.innerHTML = '<i class="fas fa-chevron-right"></i>';
                } else {
                    toggleBtn.innerHTML = '<i class="fas fa-chevron-left"></i>';
                }

                // Salva o estado no localStorage
                localStorage.setItem('sidebarCollapsed', sidebar.classList.contains('collapsed'));
            });
        });
    </script>

    @stack('scripts')
</body>

</html>
{{-- TESTE-APP-TESTE --}}{{-- TESTE-APP-TESTE --}}
