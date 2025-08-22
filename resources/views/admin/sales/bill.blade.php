<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fatura - Coco Real</title>
    <style>
        @page {
            size: A4;
            margin: 1cm;
        }

        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
            line-height: 1.4;
            color: #000;
        }

        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 20px;
            border-bottom: 2px solid #000;
            padding-bottom: 15px;
        }

        .logo {
            max-width: 220px;
            height: auto;
        }

        .info-payment-container {
            display: flex;
            justify-content: space-between;
        }

        .invoice-info {
            text-align: right;
        }

        .company-info {
            margin-bottom: 20px;
        }

        .section {
            margin-bottom: 20px;
        }

        .section-title {
            font-weight: bold;
            margin-bottom: 8px;
            border-bottom: 1px solid #ccc;
            padding-bottom: 5px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 15px;
        }

        th,
        td {
            padding: 8px;
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

        .signature-area {
            margin-top: 40px;
            padding-top: 10px;
        }

        .flex-container {
            display: flex;
            justify-content: space-between;
        }

        .payment-info {
            width: 48%;
        }

        .qrcode-container {
            text-align: end;
            width: 48%;
        }

        .qrcode {
            max-width: 150px;
            height: auto;
            border: 1px solid #ddd;
            padding: 10px;
        }

        @media print {
            body {
                font-size: 11px;
            }

            .no-print {
                display: none;
            }

            .container {
                padding: 0;
            }
        }

        .btn-print {
            background-color: #4CAF50;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            margin-bottom: 20px;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="no-print" style="text-align: center; margin-bottom: 20px;">
            <button class="btn-print" onclick="window.print()">Imprimir Fatura</button>
        </div>

        <div class="header">
            <div>
                <img src="{{ asset('admin/assets/logo_white_bg.jpg') }}" alt="Coco Real" class="logo">
            </div>
            <div class="invoice-info">
                <h2>FATURA</h2>
                <p><strong>Nº:</strong> {{ $sale->id }}</p>
                <p><strong>Emitida em:</strong> {{ \Carbon\Carbon::parse($sale->date)->format('d/m/Y') }}</p>
                <p><strong>Competência:</strong> {{ \Carbon\Carbon::parse($sale->date)->format('m/Y') }}</p>
            </div>
        </div>

        <div class="info-payment-container">
            <div class="company-info">
                <p><strong>Empresa:</strong> Coco Real</p>
                <p><strong>CNPJ:</strong> 58.795.904/0001-01</p>
                <p><strong>Email:</strong> contato@cocoreal.com.br</p>
            </div>

            <div class="qrcode-container">
                <p>Use o QR code para pagamento PIX</p>
                <img src="{{ asset('admin/assets/pix_qr_code.png') }}" alt="QR Code PIX" class="qrcode">
            </div>
        </div>

        <div class="section">
            <div class="section-title">Cliente</div>
            <p><strong>Distribuidora de Bebidas Italo Tubarão</strong></p>
            <p><strong>Endereço:</strong> Rua Varsóvia 117 Parque Residencial de Tubarão</p>
            <p><strong>Telefone:</strong> (27) 9885-1570</p>
        </div>

        <div class="section">
            <div class="section-title">Discriminação da Venda</div>
            <table>
                <thead>
                    <tr>
                        <th>Quantidade</th>
                        <th>Produto</th>
                        <th>Unitário (R$)</th>
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
                        <td colspan="3" style="text-align: right;">Valor total da venda:</td>
                        <td>R$ {{ number_format($sale->value, 2, ',', '.') }}</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="section">
            <p><strong>Previsão de entrega:</strong> {{ \Carbon\Carbon::parse($sale->delivery_time)->format('d/m/Y') }}
            </p>
            <p><strong>Prazo para pagamento:</strong>
                {{ \Carbon\Carbon::parse($sale->delivery_time)->addDays(30)->format('d/m/Y') }}</p>
        </div>

        <div class="flex-container" style="align-items: end;">
            <div class="payment-info">
                <p><strong>Data do pagamento:</strong> ____ /____ /_______</p>
                <p><strong>Forma de pagamento:</strong></p>
                <p>_________________________________________</p>
            </div>

            <div class="signature-area">
                <p><strong>Assinatura:</strong></p>
                <p>_________________________________________</p>
            </div>
        </div>
    </div>
</body>

</html>
