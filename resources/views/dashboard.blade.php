<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Painel de Vendas</title>
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
</head>

<body>

    <header>
        <nav>
            <a href="#">Cadastro</a>
            <a href="#">Comercial</a>
            <a href="#">Financeiro</a>
            <a href="#">RH</a>
            <a href="#">Configurações</a>
        </nav>
        <button class="btn-sair">Sair</button>
    </header>

    <div class="filter">
        <form method="GET" action="{{ route('dashboard') }}">
            <label>De</label>
            <input type="date" name="inicio" value="{{ $dataInicio }}">
            <label>até</label>
            <input type="date" name="fim" value="{{ $dataFim }}">
            <button type="submit">Atualizar</button>
        </form>
    </div>

    <div class="container">
        @foreach ([
        'Vendas do dia' => $dia,
        'Vendas da semana' => $semana,
        'Vendas do mês' => $mes,
        'Vendas do período' => $periodo,
    ] as $titulo => $dados)
            <div class="card">
                <h3>{{ $titulo }}</h3>
                <table>
                    <thead>
                        <tr>
                            <th>Produto</th>
                            <th>Vendas</th>
                            <th>Faturamento (R$)</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $totalVendas = 0;
                            $totalFat = 0;
                        @endphp
                        @foreach ($dados as $item)
                            @php
                                $totalVendas += $item->vendas;
                                $totalFat += $item->fat;
                            @endphp
                            <tr>
                                <td>{{ $item->produto }}</td>
                                <td>{{ $item->vendas }}</td>
                                <td>{{ number_format($item->fat, 2, ',', '.') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <td>Total</td>
                            <td>{{ $totalVendas }}</td>
                            <td>{{ number_format($totalFat, 2, ',', '.') }}</td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        @endforeach
    </div>

    <script>
        window.dashboardData = {
            dia: @json($dia),
            semana: @json($semana),
            mes: @json($mes),
            periodo: @json($periodo)
        };
    </script>
    <script src="{{ asset('js/dashboard.js') }}"></script>

</body>

</html>
