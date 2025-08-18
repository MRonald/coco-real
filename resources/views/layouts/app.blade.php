<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
{{-- TESTE-APP-TESTE --}}

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Laravel') }} | @yield('title')</title>

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
            transition: all 0.3s;
        }

        .content-area {
            flex: 1;
            padding: 20px;
        }

        .person-card {
            transition: transform 0.2s;
        }

        .person-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>
{{-- TESTE-APP-TESTE --}}{{-- TESTE-APP-TESTE --}}{{-- TESTE-APP-TESTE --}}{{-- TESTE-APP-TESTE --}}{{-- TESTE-APP-TESTE --}}

<body>
    <div class="d-flex">
        <!-- Sidebar -->
        <div class="sidebar text-white p-3">
            <h4 class="mb-4">{{ config('app.name') }}</h4>

            <ul class="nav flex-column">
                <li class="nav-item mb-2">
                    <a class="nav-link text-white active" href="{{ route('people.index') }}">
                        <i class="fas fa-users me-2"></i> People Management
                    </a>
                </li>
                <li class="nav-item mb-2">
                    <a class="nav-link text-white" href="{{ route('users.index') }}">
                        <i class="fas fa-user-cog me-2"></i> User Management
                    </a>
                </li>
            </ul>
        </div>

        <!-- Main Content -->
        <div class="content-area">
            @yield('content')
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    @stack('scripts')
</body>

</html>

{{-- TESTE-APP-TESTE --}}
