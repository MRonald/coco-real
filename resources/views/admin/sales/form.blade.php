@extends('layouts.admin')

@section('content')
    <main role="main" class="main-content">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-12">
                    <h2 class="page-title">
                        @if (isset($sale->id))
                            Editar
                        @else
                            Criar
                        @endif
                        Produto
                    </h2>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card shadow mb-4">
                                <div class="card-body">
                                    <form class="form-validation" method="POST" action="{{ route('sales.store') }}">
                                        @csrf
                                        <input type="hidden" name="id" value="{{ $sale->id ?? '' }}" />

                                        <div class="form-row">
                                            <div class="form-group col-md-12">
                                                <label for="client_id">Cliente</label>
                                                <select class="custom-select required-validation" id="client_id"
                                                    name="client_id">
                                                    <option selected disabled>Selecione</option>
                                                    @foreach ($clients as $client)
                                                        <option value="{{ $client->id }}"
                                                            @if (isset($sale->id) && $client->id === $sale->client_id) selected @endif>
                                                            {{ $client->id }} - {{ $client->name }} - {{ $client->email }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                <div class="invalid-feedback"></div>
                                            </div>
                                        </div>

                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label for="date">Data da Venda</label>
                                                <input type="text" name="date" id="date"
                                                    value="{{ isset($sale->date) ? \Carbon\Carbon::parse($sale->date)->format('d/m/Y') : \Carbon\Carbon::now()->format('d/m/Y') }}"
                                                    class="form-control datepicker required-validation">
                                                <div class="invalid-feedback"></div>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="delivery_time">Previsão de Entrega</label>
                                                <input type="text" name="delivery_time" id="delivery_time"
                                                    value="{{ isset($sale->delivery_time) ? \Carbon\Carbon::parse($sale->delivery_time)->format('d/m/Y') : '' }}"
                                                    class="form-control datepicker required-validation">
                                                <div class="invalid-feedback"></div>
                                            </div>
                                        </div>

                                        <hr>

                                        <div class="d-flex justify-content-between align-items-center mb-3">
                                            <h5>Produtos</h5>
                                            <button type="button" id="add-product" class="btn btn-sm btn-primary">
                                                <i class="fe fe-plus"></i> Adicionar Produto
                                            </button>
                                        </div>

                                        <div id="products-container">
                                            @if (isset($sale->id))
                                                @foreach ($sale->products as $saleProduct)
                                                    <div class="product-row form-row" data-index="0">
                                                        <div class="form-group col-md-2">
                                                            <label for="quantity0">Quantidade</label>
                                                            <input type="number" name="products[0][quantity]"
                                                                id="quantity0"
                                                                class="form-control required-validation quantity"
                                                                value="{{ $saleProduct->pivot->quantity }}" min="1">
                                                            <div class="invalid-feedback"></div>
                                                        </div>

                                                        <div class="form-group col-md-5">
                                                            <label for="product0">Produto</label>
                                                            <select class="custom-select required-validation product-select"
                                                                id="product0" name="products[0][product_id]">
                                                                <option selected disabled>Selecione</option>
                                                                @foreach ($products as $product)
                                                                    <option value="{{ $product->id }}"
                                                                        data-price="{{ $product->unit_value }}"
                                                                        @if ($saleProduct->id === $product->id) selected @endif>
                                                                        {{ $product->name }} - R$
                                                                        {{ number_format($product->unit_value, 2, ',', '.') }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                            <div class="invalid-feedback"></div>
                                                        </div>

                                                        <div class="form-group col-md-2">
                                                            <label for="unit_value0">Valor Unitário</label>
                                                            <input type="number" id="unit_value0"
                                                                class="form-control required-validation unit-value"
                                                                step="0.01" placeholder="0.00" readonly
                                                                value="{{ $saleProduct->pivot->unit_value }}">
                                                            <div class="invalid-feedback"></div>
                                                        </div>

                                                        <div class="form-group col-md-2">
                                                            <label for="total0">Total</label>
                                                            <input type="number" id="total0"
                                                                class="form-control required-validation total"
                                                                step="0.01" placeholder="0.00" readonly
                                                                value="{{ $saleProduct->pivot->unit_value * $saleProduct->pivot->quantity }}">
                                                            <div class="invalid-feedback"></div>
                                                        </div>

                                                        <div class="form-group col-md-1 d-flex align-items-end">
                                                            <button type="button" class="btn btn-danger remove-product">
                                                                <i class="fe fe-trash"></i>
                                                            </button>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            @else
                                                <div class="product-row form-row" data-index="0">
                                                    <div class="form-group col-md-2">
                                                        <label for="quantity0">Quantidade</label>
                                                        <input type="number" name="products[0][quantity]" id="quantity0"
                                                            class="form-control required-validation quantity" value="1"
                                                            min="1">
                                                        <div class="invalid-feedback"></div>
                                                    </div>

                                                    <div class="form-group col-md-5">
                                                        <label for="product0">Produto</label>
                                                        <select class="custom-select required-validation product-select"
                                                            id="product0" name="products[0][product_id]">
                                                            <option selected disabled>Selecione</option>
                                                            @foreach ($products as $product)
                                                                <option value="{{ $product->id }}"
                                                                    data-price="{{ $product->unit_value }}">
                                                                    {{ $product->name }} - R$
                                                                    {{ number_format($product->unit_value, 2, ',', '.') }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                        <div class="invalid-feedback"></div>
                                                    </div>

                                                    <div class="form-group col-md-2">
                                                        <label for="unit_value0">Valor Unitário</label>
                                                        <input type="number" id="unit_value0"
                                                            class="form-control required-validation unit-value"
                                                            step="0.01" placeholder="0.00" readonly>
                                                        <div class="invalid-feedback"></div>
                                                    </div>

                                                    <div class="form-group col-md-2">
                                                        <label for="total0">Total</label>
                                                        <input type="number" id="total0"
                                                            class="form-control required-validation total" step="0.01"
                                                            placeholder="0.00" readonly>
                                                        <div class="invalid-feedback"></div>
                                                    </div>

                                                    <div class="form-group col-md-1 d-flex align-items-end">
                                                        <button type="button" class="btn btn-danger remove-product">
                                                            <i class="fe fe-trash"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                            @endif
                                        </div>

                                        <hr>

                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label for="discount">Desconto (R$)</label>
                                                <input type="number" name="discount" id="discount"
                                                    value="{{ $sale->discount ?? 0 }}" class="form-control"
                                                    step="0.01" placeholder="0.00">
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="value">Total Geral</label>
                                                <input type="number" name="value" id="value" class="form-control"
                                                    step="0.01" placeholder="0.00" readonly>
                                            </div>
                                        </div>

                                        <button type="submit" class="btn btn-primary">
                                            @if (isset($sale->id))
                                                Atualizar
                                            @else
                                                Cadastrar
                                            @endif
                                        </button>
                                    </form>
                                </div> <!-- /. card-body -->
                            </div> <!-- /. card -->
                        </div> <!-- /. col -->
                    </div> <!-- /. end-section -->
                </div> <!-- .col-12 -->
            </div> <!-- .row -->
        </div> <!-- .container-fluid -->
    </main> <!-- main -->
@endsection

@section('script')
    <script>
        $(document).ready(function() {
            // Variável para controlar os índices dos produtos
            let productIndex = 1;

            // Adicionar novo produto
            $('#add-product').click(function() {
                const newRow = $(`
            <div class="product-row form-row" data-index="${productIndex}">
                <div class="form-group col-md-2">
                    <input type="number" name="products[${productIndex}][quantity]" id="quantity${productIndex}"
                        class="form-control required-validation quantity" value="1" min="1">
                    <div class="invalid-feedback"></div>
                </div>

                <div class="form-group col-md-5">
                    <select class="custom-select required-validation product-select"
                            id="product${productIndex}" name="products[${productIndex}][product_id]">
                        <option selected disabled>Selecione</option>
                        @foreach ($products as $product)
                            <option value="{{ $product->id }}"
                                data-price="{{ $product->unit_value }}">
                                {{ $product->name }} - R$
                                {{ number_format($product->unit_value, 2, ',', '.') }}
                            </option>
                        @endforeach
                    </select>
                    <div class="invalid-feedback"></div>
                </div>

                <div class="form-group col-md-2">
                    <input type="number" id="unit_value${productIndex}"
                        class="form-control required-validation unit-value" step="0.01"
                        placeholder="0.00" readonly>
                    <div class="invalid-feedback"></div>
                </div>

                <div class="form-group col-md-2">
                    <input type="number" id="total${productIndex}"
                        class="form-control required-validation total" step="0.01"
                        placeholder="0.00" readonly>
                    <div class="invalid-feedback"></div>
                </div>

                <div class="form-group col-md-1 d-flex align-items-end">
                    <button type="button" class="btn btn-danger remove-product">
                        <i class="fe fe-trash"></i>
                    </button>
                </div>
            </div>
        `);

                $('#products-container').append(newRow);

                // Mostrar botão de remover no primeiro produto se houver mais de um
                if (productIndex === 1) {
                    $('.product-row[data-index="0"] .remove-product').show();
                }

                productIndex++;
            });

            // Remover produto
            $(document).on('click', '.remove-product', function() {
                const row = $(this).closest('.product-row');
                const index = row.data('index');

                row.remove();

                // Reorganizar índices se necessário
                // ...

                // Esconder botão de remover do primeiro produto se só restar um
                if ($('.product-row').length === 1) {
                    $('.product-row[data-index="0"] .remove-product').hide();
                }

                calculateGrandTotal();
            });

            // Atualizar valor unitário quando selecionar um produto
            $(document).on('change', '.product-select', function() {
                const selectedOption = $(this).find('option:selected');
                const price = selectedOption.data('price') || 0;
                const index = $(this).closest('.product-row').data('index');

                $(`#unit_value${index}`).val(price);
                calculateRowTotal(index);
                calculateGrandTotal();
            });

            // Atualizar total da linha quando quantidade ou preço mudar
            $(document).on('input', '.quantity, .unit-value', function() {
                const index = $(this).closest('.product-row').data('index');
                calculateRowTotal(index);
                calculateGrandTotal();
            });

            // Calcular total da linha
            function calculateRowTotal(index) {
                const quantity = parseFloat($(`#quantity${index}`).val()) || 0;
                const unitValue = parseFloat($(`#unit_value${index}`).val()) || 0;
                const total = quantity * unitValue;

                $(`#total${index}`).val(total.toFixed(2));
            }

            // Calcular total geral
            function calculateGrandTotal() {
                let grandTotal = 0;
                let discount = parseFloat($('#discount').val()) || 0;

                $('.total').each(function() {
                    grandTotal += parseFloat($(this).val()) || 0;
                });

                grandTotal -= discount;

                $('#value').val(grandTotal.toFixed(2));
            }

            // Calcular desconto
            $('#discount').on('input', function() {
                calculateGrandTotal();
            });

            // Inicializar cálculos
            calculateGrandTotal();
        });
    </script>
@endsection
