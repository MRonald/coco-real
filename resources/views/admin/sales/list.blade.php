@extends('layouts.admin')

@section('content')
    <main role="main" class="main-content">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-12">
                    <div class="d-flex justify-content-between align-items-center">
                        <h2 class="page-title m-0">Lista de Vendas</h2>
                        <a href="{{ route('sales.create') }}" class="btn btn-primary">
                            Criar
                        </a>
                    </div>
                    <div class="row my-4">
                        <!-- Small table -->
                        <div class="col-md-12">
                            <div class="card shadow">
                                <div class="card-body">
                                    <!-- table -->
                                    <table class="table datatables" id="dataTable-1">
                                        <thead>
                                            <tr>
                                                <th>Nº Pedido</th>
                                                <th>Cliente</th>
                                                <th>Data</th>
                                                <th>Produtos</th>
                                                <th>Valor Total</th>
                                                <th>Ações</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($sales as $sale)
                                                <tr>
                                                    <td>{{ $sale->id }}</td>
                                                    <td>{{ $sale->client->name }}</td>
                                                    <td>{{ \Carbon\Carbon::parse($sale->date)->format('d/m/Y') }}</td>
                                                    <td>
                                                        @foreach ($sale->products as $product)
                                                            {{ $product->name }}: <b>{{ $product->pivot->quantity }}</b><br>
                                                        @endforeach
                                                    </td>
                                                    <td>R$ {{ $sale->value }}</td>
                                                    <td>
                                                        <button class="btn btn-sm dropdown-toggle more-horizontal"
                                                            type="button" data-toggle="dropdown" aria-haspopup="true"
                                                            aria-expanded="false">
                                                        </button>
                                                        <div class="dropdown-menu dropdown-menu-right">
                                                            <a class="dropdown-item"
                                                                href="{{ route('sales.bill', $sale->id) }}"
                                                                target="_blank">Ver fatura</a>
                                                            <a class="dropdown-item"
                                                                href="{{ route('sales.edit', $sale->id) }}">Editar</a>
                                                            <a class="dropdown-item" id="btnModalDelete" href="#"
                                                                data-item-id="{{ $sale->id }}" data-toggle="modal"
                                                                data-target="#confirmDelete">Excluir</a>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div> <!-- simple table -->
                    </div> <!-- end section -->
                </div> <!-- .col-12 -->
            </div> <!-- .row -->
        </div> <!-- .container-fluid -->
    </main> <!-- main -->

    <!-- Modal confirm delete -->
    <div class="modal fade" id="confirmDelete" tabindex="-1" role="dialog" aria-labelledby="verticalModalTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="verticalModalTitle">Excluir</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">Tem certeza que deseja excluir este registro da plataforma?</div>
                <div class="modal-footer">
                    <button type="button" class="btn mb-2 btn-secondary" data-dismiss="modal">Fechar</button>
                    <a href="#" id="btnConfirmDelete" class="btn mb-2 btn-primary">Excluir</a>
                </div>
            </div>
        </div>
    </div>
@endsection


@section('script')
    <script>
        @if (session('message'))
            toastr.success('{{ session('message') }}');
        @endif

        $(document).delegate('#btnModalDelete', 'click', function() {
            $('#btnConfirmDelete').attr('href', `/admin/sales/${$(this).data('item-id')}/delete`);
        });
    </script>
@endsection
