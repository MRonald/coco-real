<!DOCTYPE html>
<html lang="pt-BR">

{{-- apenas para teste --}}{{-- apenas para teste --}}{{-- apenas para teste --}}{{-- apenas para teste --}}


<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name') }} | @yield('title')</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

    <style>
        :root {
            --primary-dark: #2c3e50;
            --primary: #3498db;
            --danger: #e74c3c;
            --success: #2ecc71;
            --warning: #f39c12;
            --info: #1abc9c;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f8f9fa;
        }

        .top-nav {
            background-color: var(--primary-dark);
        }

        .badge-primary {
            background-color: var(--primary);
        }

        .badge-success {
            background-color: var(--success);
        }

        .badge-danger {
            background-color: var(--danger);
        }

        .badge-warning {
            background-color: var(--warning);
        }

        .badge-info {
            background-color: var(--info);
        }

        .btn-primary {
            background-color: var(--primary);
            border-color: var(--primary);
        }

        .btn-danger {
            background-color: var(--danger);
            border-color: var(--danger);
        }

        .btn-success {
            background-color: var(--success);
            border-color: var(--success);
        }
    </style>
</head>

<body>
    @yield('content')

    @yield('scripts')
</body>

</html>

{{-- apenas para teste --}}
