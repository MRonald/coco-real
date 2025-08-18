@extends('layouts.app')

@section('title', 'Cadastro de Pessoas')

@section('content')
    <div class="container-fluid">
        <div class="top-nav bg-primary-dark text-white p-3">
            <div class="d-flex justify-content-between align-items-center">
                <div class="d-flex gap-4">
                    <a href="#" class="text-white text-decoration-none font-weight-bold">Cadastro</a>
                    <a href="#" class="text-white text-decoration-none font-weight-bold">Comercial</a>
                    <a href="#" class="text-white text-decoration-none font-weight-bold">Financeiro</a>
                    <a href="#" class="text-white text-decoration-none font-weight-bold">RH</a>
                    <a href="#" class="text-white text-decoration-none font-weight-bold">Configurações</a>
                </div>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="btn btn-danger btn-sm">
                        <i class="fas fa-sign-out-alt"></i> Sair
                    </button>
                </form>
            </div>
        </div>

        <div class="card shadow-sm mt-3 mx-3">
            <div class="card-header bg-white">
                <div class="d-flex justify-content-between align-items-center">
                    <h4 class="mb-0">Pessoas</h4>
                    <button class="btn btn-primary" data-toggle="modal" data-target="#personModal">
                        <i class="fas fa-plus"></i> Cadastrar...
                    </button>
                </div>
            </div>

            <div class="card-body">
                <div class="row mb-4">
                    <div class="col-md-12">
                        <form class="form-inline">
                            <div class="form-group mr-3">
                                <select class="form-control" name="status">
                                    <option value="active">Ativos</option>
                                    <option value="inactive">Inativos</option>
                                </select>
                            </div>

                            <div class="form-group mr-3">
                                <select class="form-control" name="nature">
                                    <option value="">Natureza</option>
                                    <option value="physical">Física</option>
                                    <option value="legal">Jurídica</option>
                                </select>
                            </div>

                            <div class="form-group mr-3">
                                <select class="form-control" name="condition">
                                    <option value="">Condição</option>
                                    <option value="is_client">Cliente</option>
                                    <option value="is_supplier">Fornecedor</option>
                                    <option value="is_employee">Colaborador</option>
                                </select>
                            </div>

                            <div class="form-group mr-3">
                                <input type="text" class="form-control" placeholder="Nome" name="name"
                                    value="{{ request('name') }}">
                            </div>

                            <div class="form-group mr-3">
                                <input type="text" class="form-control" placeholder="CPF/CNPJ" name="document"
                                    value="{{ request('document') }}">
                            </div>

                            <button type="submit" class="btn btn-secondary">
                                <i class="fas fa-filter"></i> Exibir
                            </button>
                        </form>
                    </div>
                </div>

                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead class="bg-light">
                            <tr>
                                <th>ID</th>
                                <th>Nome</th>
                                <th>Unidade de Negócio</th>
                                <th>Natureza</th>
                                <th>CPF/CNPJ</th>
                                <th>Condição</th>
                                <th>Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($people as $person)
                                <tr>
                                    <td>{{ $person->id }}</td>
                                    <td>
                                        {{ $person->name }}
                                        @if (!$person->has_price_table)
                                            <span class="badge badge-danger">Sem tabela de preço</span>
                                        @endif
                                    </td>
                                    <td>{{ $person->business_unit ?? '-' }}</td>
                                    <td>{{ $person->nature === 'physical' ? 'Física' : 'Jurídica' }}</td>
                                    <td>{{ $person->document_formatted }}</td>
                                    <td>
                                        @if ($person->is_client)
                                            <span class="badge badge-primary">Cliente</span>
                                        @endif
                                        @if ($person->is_supplier)
                                            <span class="badge badge-success">Fornecedor</span>
                                        @endif
                                        @if ($person->is_employee)
                                            <span class="badge badge-info">Colaborador</span>
                                        @endif
                                        @if ($person->is_partner)
                                            <span class="badge badge-warning">Sócio</span>
                                        @endif
                                    </td>
                                    <td>
                                        <button class="btn btn-sm btn-outline-primary edit-btn"
                                            data-id="{{ $person->id }}" data-toggle="modal" data-target="#personModal">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <button class="btn btn-sm btn-outline-danger delete-btn"
                                            data-id="{{ $person->id }}">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Rodapé -->
                <div class="d-flex justify-content-between align-items-center mt-3">
                    <div class="text-muted">
                        Total de Pessoas: {{ $people->total() }}
                    </div>
                    <div>
                        <button class="btn btn-outline-secondary">
                            <i class="fas fa-file-export"></i> Relatórios...
                        </button>
                    </div>
                </div>

                <div class="d-flex justify-content-center mt-3">
                    {{ $people->links() }}
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="personModal" tabindex="-1" role="dialog" aria-labelledby="personModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title" id="personModalLabel">Cadastro Pessoa</h5>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="personForm" method="POST">
                    @csrf
                    <input type="hidden" id="person_id" name="id">

                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="nature">Natureza</label>
                                    <select class="form-control" id="nature" name="nature" required>
                                        <option value="physical">Física</option>
                                        <option value="legal">Jurídica</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="document_type">Tipo de Documento</label>
                                    <select class="form-control" id="document_type" name="document_type" required>
                                        <option value="cpf">CPF</option>
                                        <option value="cnpj">CNPJ</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="name">Nome</label>
                                    <input type="text" class="form-control" id="name" name="name" required>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label id="document_label">CPF</label>
                                    <input type="text" class="form-control" id="document" name="document" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="ie">I.E.</label>
                                    <input type="text" class="form-control" id="ie" name="ie">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="icms_taxpayer">Contribuinte ICMS</label>
                                    <select class="form-control" id="icms_taxpayer" name="icms_taxpayer">
                                        <option value="0">Não</option>
                                        <option value="1">Sim</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="business_unit">Unidade de Negócio</label>
                                    <input type="text" class="form-control" id="business_unit" name="business_unit">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="cep">CEP</label>
                                    <input type="text" class="form-control" id="cep" name="cep">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="address">Endereço</label>
                                    <input type="text" class="form-control" id="address" name="address">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="number">Número</label>
                                    <input type="text" class="form-control" id="number" name="number">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="complement">Complemento</label>
                                    <input type="text" class="form-control" id="complement" name="complement">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="state">UF</label>
                                    <select class="form-control" id="state" name="state">
                                        <option value="">Selecione</option>
                                        @foreach ($states as $uf => $name)
                                            <option value="{{ $uf }}">{{ $uf }} -
                                                {{ $name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="city">Município</label>
                                    <input type="text" class="form-control" id="city" name="city">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="neighborhood">Bairro</label>
                                    <input type="text" class="form-control" id="neighborhood" name="neighborhood">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="email" class="form-control" id="email" name="email">
                                    <small class="text-danger" id="email-error" style="display: none;">
                                        <i class="fas fa-exclamation-circle"></i> Email inválido
                                    </small>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="phone">Telefone</label>
                                    <input type="text" class="form-control" id="phone" name="phone">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Condição</label>
                                    <div class="d-flex flex-wrap">
                                        <div class="custom-control custom-checkbox mr-3">
                                            <input type="checkbox" class="custom-control-input" id="is_client"
                                                name="is_client">
                                            <label class="custom-control-label" for="is_client">Cliente</label>
                                        </div>
                                        <div class="custom-control custom-checkbox mr-3">
                                            <input type="checkbox" class="custom-control-input" id="is_employee"
                                                name="is_employee">
                                            <label class="custom-control-label" for="is_employee">Colaborador</label>
                                        </div>
                                        <div class="custom-control custom-checkbox mr-3">
                                            <input type="checkbox" class="custom-control-input" id="is_supplier"
                                                name="is_supplier">
                                            <label class="custom-control-label" for="is_supplier">Fornecedor</label>
                                        </div>
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" id="is_partner"
                                                name="is_partner">
                                            <label class="custom-control-label" for="is_partner">Sócio</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-primary">Cadastrar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title" id="deleteModalLabel">Confirmar Exclusão</h5>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Tem certeza que deseja excluir esta pessoa? Esta ação não pode ser desfeita.
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <form id="deleteForm" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Excluir</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>
    <script>
        $(document).ready(function() {
            // Alternar entre CPF e CNPJ
            $('#document_type').change(function() {
                if ($(this).val() === 'cpf') {
                    $('#document_label').text('CPF');
                    $('#document').mask('000.000.000-00');
                } else {
                    $('#document_label').text('CNPJ');
                    $('#document').mask('00.000.000/0000-00');
                }
            });

            // Máscaras para os campos
            $('#document').mask('000.000.000-00');
            $('#phone').mask('(00) 00000-0000');
            $('#cep').mask('00000-000');

            // Buscar CEP
            $('#cep').blur(function() {
                const cep = $(this).val().replace(/\D/g, '');
                if (cep.length === 8) {
                    $.getJSON(`https://viacep.com.br/ws/${cep}/json/`, function(data) {
                        if (!data.erro) {
                            $('#address').val(data.logradouro);
                            $('#neighborhood').val(data.bairro);
                            $('#city').val(data.localidade);
                            $('#state').val(data.uf);
                        }
                    });
                }
            });

            $('.edit-btn').click(function() {
                const personId = $(this).data('id');
                $('#personForm').attr('action', `/people/${personId}`);
                $('#person_id').val(personId);
                $('#personModalLabel').text('Editar Pessoa');
                $('.modal-footer button[type="submit"]').text('Atualizar');


            });

            $('#personModal').on('show.bs.modal', function(e) {
                if (!$(e.relatedTarget).hasClass('edit-btn')) {
                    $('#personForm').attr('action', '/people');
                    $('#person_id').val('');
                    $('#personModalLabel').text('Cadastrar Pessoa');
                    $('.modal-footer button[type="submit"]').text('Cadastrar');
                    $('#personForm')[0].reset();
                }
            });

            $('.delete-btn').click(function() {
                const personId = $(this).data('id');
                $('#deleteForm').attr('action', `/people/${personId}`);
                $('#deleteModal').modal('show');
            });

            $('#email').blur(function() {
                const email = $(this).val();
                if (email && !/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email)) {
                    $('#email-error').show();
                } else {
                    $('#email-error').hide();
                }
            });
        });
    </script>
@endsection
