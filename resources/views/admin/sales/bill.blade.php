<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fatura - Coco Real</title>
    <style>
        @page {
            size: A5;
            margin: 0.5cm;
        }

        body {
            font-family: Arial, sans-serif;
            font-size: 10px;
            line-height: 1.2;
            color: #000;
            margin: 0;
            padding: 0;
        }

        .container {
            width: 100%;
            max-width: 100%;
            padding: 10px;
            box-sizing: border-box;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 10px;
            border-bottom: 1px solid #000;
            padding-bottom: 8px;
        }

        .logo {
            max-width: 100px;
            height: auto;
        }

        .invoice-info h2 {
            margin: 0;
            font-size: 12px;
        }

        .invoice-info p {
            margin: 2px 0;
        }

        .info-payment-container {
            display: flex;
            justify-content: space-between;
            margin-bottom: 5px;
        }

        .company-info p {
            margin: 2px 0;
        }

        .qrcode-container {
            text-align: end;
        }

        .qrcode {
            max-width: 60px;
            height: auto;
            border: 1px solid #ddd;
            padding: 3px;
        }

        .section {
            margin-bottom: 10px;
        }

        .section-title {
            font-weight: bold;
            margin-bottom: 5px;
            border-top: 1px solid #ccc;
            padding-top: 3px;
            font-size: 10px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 8px;
            font-size: 9px;
        }

        th,
        td {
            padding: 4px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #f5f5f5;
            font-weight: bold;
        }

        .total-row {
            font-weight: bold;
            background-color: #f9f9f9;
        }

        .flex-container {
            display: flex;
            justify-content: space-between;
            margin-top: 15px;
        }

        .payment-info,
        .signature-area {
            width: 48%;
        }

        .signature-area {
            margin-top: 0;
            padding-top: 0;
        }

        @media print {
            body {
                font-size: 9px;
            }

            .no-print {
                display: none;
            }

            .container {
                padding: 5px;
            }
        }

        .btn-print {
            background-color: #4CAF50;
            color: white;
            padding: 8px 12px;
            border: none;
            border-radius: 3px;
            cursor: pointer;
            margin-bottom: 10px;
            font-size: 10px;
        }

        .compact-text {
            margin: 2px 0;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="no-print" style="text-align: center; margin-bottom: 10px;">
            <button class="btn-print" onclick="window.print()">Imprimir Fatura</button>
        </div>

        <div class="header">
            <div>
                <img src="{{ asset('admin/assets/logo_white_bg.jpg') }}" alt="Coco Real" class="logo">
            </div>
            <div class="invoice-info">
                <h2 class="compact-text">FATURA</h2>
                <p class="compact-text"><strong>Nº:</strong> {{ $sale->id }}</p>
                <p class="compact-text"><strong>Emitida em:</strong>
                    {{ \Carbon\Carbon::parse($sale->date)->format('d/m/Y') }}</p>
                <p class="compact-text"><strong>Competência:</strong>
                    {{ \Carbon\Carbon::parse($sale->date)->format('m/Y') }}</p>
            </div>
        </div>

        <div class="info-payment-container">
            <div class="company-info">
                <p class="compact-text"><strong>Empresa:</strong> Coco Real</p>
                <p class="compact-text"><strong>CNPJ:</strong> 58.795.904/0001-01</p>
                <p class="compact-text"><strong>Email:</strong> contato@cocoreal.com.br</p>
            </div>
            <div class="qrcode-container">
                <p class="compact-text">Pague via PIX</p>
                <img src="{{ asset('admin/assets/pix_qr_code.png') }}" alt="QR Code PIX" class="qrcode">
            </div>
        </div>

        <div class="section section-title">
            <div style="display: flex; justify-content: space-between;">
                <p class="compact-text">Cliente</p>
                <p class="compact-text"><strong>{{ $sale->client->name }}</strong></p>
            </div>
        </div>

        <div class="section">
            <div class="section-title">Discriminação da Venda</div>
            <table>
                <thead>
                    <tr>
                        <th>Qtd</th>
                        <th>Produto</th>
                        <th>Unit. (R$)</th>
                        <th>Total (R$)</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($sale->products as $product)
                        <tr>
                            <td>{{ $product->pivot->quantity }}</td>
                            <td>{{ $product->name }}</td>
                            <td>{{ number_format($product->pivot->unit_value, 2, ',', '.') }}</td>
                            <td>{{ number_format($product->pivot->quantity * $product->pivot->unit_value, 2, ',', '.') }}
                            </td>
                        </tr>
                    @endforeach
                    <tr class="total-row">
                        <td colspan="3" style="text-align: right;">Valor total:</td>
                        <td>R$ {{ number_format($sale->value, 2, ',', '.') }}</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="section">
            <p class="compact-text"><strong>Entrega:</strong>
                {{ \Carbon\Carbon::parse($sale->delivery_time)->format('d/m/Y') }}</p>
            <p class="compact-text"><strong>Vencimento:</strong>
                {{ \Carbon\Carbon::parse($sale->delivery_time)->addDays(30)->format('d/m/Y') }}</p>
        </div>

        <div class="flex-container">
            <p class="compact-text"><strong>Data pagamento:</strong> ____/____/______</p>
            <p class="compact-text"><strong>Forma de pagamento:</strong> _________________________</p>
            <p class="compact-text"><strong>Assinatura:</strong> _________________________</p>
        </div>
    </div>
</body>

</html>
