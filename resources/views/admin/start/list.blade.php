@extends('layouts.admin')

@section('content')
    <main sale="main" class="main-content">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-12">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card shadow">
                                <div class="card-body">
                                    <form class="form-row" method="GET" action="{{ route('sales.dashboard') }}">
                                        <div class="form-group col-md-3">
                                            <label for="type">Tipo de usuário</label>
                                            <select class="custom-select required-validation" id="type" name="type">
                                                <option value="daily" @if (request('type') == 'daily') selected @endif>
                                                    Diário
                                                </option>
                                                <option value="weekly" @if (request('type') == 'weekly') selected @endif>
                                                    Semanal
                                                </option>
                                                <option value="monthly" @if (request('type') == 'monthly') selected @endif>
                                                    Mensal
                                                </option>
                                                <option value="period" @if (request('type') == 'period') selected @endif>
                                                    Período
                                                </option>
                                            </select>
                                            <div class="invalid-feedback"></div>
                                        </div>

                                        <div class="form-group col-md-4">
                                            <label for="init_date">Início Período</label>
                                            <input type="text" name="init_date" id="init_date"
                                                value="{{ isset($initDate)? \Carbon\Carbon::parse($initDate)->format('d/m/Y'): \Carbon\Carbon::now()->addMonths(-1)->format('d/m/Y') }}"
                                                class="form-control datepicker required-validation"
                                                @if (request('type') != 'period') disabled @endif>
                                            <div class="invalid-feedback"></div>
                                        </div>

                                        <div class="form-group col-md-4">
                                            <label for="end_date">Fim Período</label>
                                            <input type="text" name="end_date" id="end_date"
                                                value="{{ isset($endDate) ? \Carbon\Carbon::parse($endDate)->format('d/m/Y') : \Carbon\Carbon::now()->format('d/m/Y') }}"
                                                class="form-control datepicker required-validation"
                                                @if (request('type') != 'period') disabled @endif>
                                            <div class="invalid-feedback"></div>
                                        </div>

                                        <div class="form-group col-md-1 d-flex align-items-end">
                                            <button type="submit" class="btn btn-primary" style="height: fit-content;">
                                                Filtrar
                                            </button>
                                        </div>
                                    </form>
                                </div> <!-- /. card-body -->
                            </div> <!-- /. card -->
                        </div> <!-- /. col -->
                    </div> <!-- end section -->

                    <div class="row my-4">
                        <!-- Small table -->
                        <div class="col-md-12">
                            <div class="card shadow">
                                <div class="card-body">
                                    <!-- table -->
                                    <table class="table datatables" id="dataTable-1">
                                        <thead>
                                            <tr>
                                                <th>Id Produto</th>
                                                <th>Nome Produto</th>
                                                <th>Vendas</th>
                                                <th>Faturamento (R$)</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($products as $product)
                                                <tr>
                                                    <td>{{ $product->id }}</td>
                                                    <td>{{ $product->name }}</td>
                                                    <td>{{ $product->total_quantity }}</td>
                                                    <td>R$ {{ number_format($product->total_value, 2, ',', '.') }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div> <!-- simple table -->
                    </div> <!-- end section -->

                    <div class="row">
                        <div class="col-md-12">
                            <div class="card shadow">
                                <div class="card-body">
                                    <div class="row align-items-center">
                                        <div class="col">
                                            <b class="mb-1">Total</b>
                                            <p class="small text-muted mb-0"><span>Somatório total do período atual</span>
                                            </p>
                                        </div>
                                        <div class="col-4 text-right">
                                            <h3 class="card-title mb-0">R$ {{ number_format($total, 2, ',', '.') }}</h3>
                                        </div>
                                    </div> <!-- /. row -->
                                </div> <!-- /. card-body -->
                            </div> <!-- /. card -->
                        </div> <!-- /. col -->
                    </div> <!-- end section -->
                </div> <!-- .col-12 -->
            </div> <!-- .row -->
        </div> <!-- .container-fluid -->
    </main> <!-- main -->
@endsection

@section('script')
    <script>
        $('#type').change(function() {
            if ($(this).val() !== 'period') {
                $('#init_date, #end_date').prop('disabled', true);
            } else {
                $('#init_date, #end_date').prop('disabled', false);
            }
        });
    </script>
@endsection
