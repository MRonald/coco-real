@extends('layouts.admin')

@section('content')
    <main role="main" class="main-content">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-12">
                    <h2 class="page-title">
                        @if (isset($user->id))
                            Editar
                        @else
                            Criar
                        @endif
                        Usuário
                    </h2>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card shadow mb-4">
                                <div class="card-body">
                                    <form class="form-validation" method="POST" action="{{ route('users.store') }}">
                                        @csrf
                                        <input type="hidden" name="id" value="{{ $user->id ?? '' }}" />

                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label for="name">Nome</label>
                                                <input type="text" name="name" id="name"
                                                    value="{{ $user->name ?? '' }}"
                                                    class="form-control required-validation">
                                                <div class="invalid-feedback"></div>
                                            </div>

                                            <div class="form-group col-md-6">
                                                <label for="document">CPF/CNPJ</label>
                                                <input type="text" name="document" id="document"
                                                    value="{{ $user->document ?? '' }}" class="form-control">
                                                <div class="invalid-feedback"></div>
                                            </div>
                                        </div>

                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label for="email">Email</label>
                                                <input type="email" name="email" id="email"
                                                    value="{{ $user->email ?? '' }}"
                                                    class="form-control required-validation">
                                                <div class="invalid-feedback"></div>
                                            </div>

                                            <div class="form-group col-md-6">
                                                <label for="phone">Telefone</label>
                                                <input type="text" name="phone" id="phone"
                                                    value="{{ $user->phone ?? '' }}" class="form-control">
                                                <div class="invalid-feedback"></div>
                                            </div>
                                        </div>

                                        <div class="form-row">
                                            <div class="form-group col-md-3">
                                                <label for="zip_code">CEP</label>
                                                <input type="text" name="zip_code" id="zip_code"
                                                    value="{{ $user->zip_code ?? '' }}" class="form-control">
                                                <div class="invalid-feedback"></div>
                                            </div>

                                            <div class="form-group col-md-7">
                                                <label for="public_place">Endereço</label>
                                                <input type="text" name="public_place" id="public_place"
                                                    value="{{ $user->public_place ?? '' }}" class="form-control">
                                                <div class="invalid-feedback"></div>
                                            </div>

                                            <div class="form-group col-md-2">
                                                <label for="number">Número</label>
                                                <input type="text" name="number" id="number"
                                                    value="{{ $user->number ?? '' }}" class="form-control">
                                                <div class="invalid-feedback"></div>
                                            </div>
                                        </div>

                                        <div class="form-row">
                                            <div class="form-group col-md-4">
                                                <label for="complement">Complemento</label>
                                                <input type="text" name="complement" id="complement"
                                                    value="{{ $user->complement ?? '' }}" class="form-control">
                                                <div class="invalid-feedback"></div>
                                            </div>

                                            <div class="form-group col-md-3">
                                                <label for="district">Bairro</label>
                                                <input type="text" name="district" id="district"
                                                    value="{{ $user->district ?? '' }}" class="form-control">
                                                <div class="invalid-feedback"></div>
                                            </div>

                                            <div class="form-group col-md-3">
                                                <label for="city">Cidade</label>
                                                <input type="text" name="city" id="city"
                                                    value="{{ $user->city ?? '' }}" class="form-control">
                                                <div class="invalid-feedback"></div>
                                            </div>

                                            <div class="form-group col-md-2">
                                                <label for="state">Estado</label>
                                                <input type="text" name="state" id="state"
                                                    value="{{ $user->state ?? '' }}" class="form-control">
                                                <div class="invalid-feedback"></div>
                                            </div>
                                        </div>

                                        <div class="form-row">
                                            <div class="form-group col-md-12">
                                                <label for="type">Tipo de usuário</label>
                                                <select class="custom-select required-validation" id="type"
                                                    name="type">
                                                    <option selected disabled>Selecione</option>
                                                    <option value="admin"
                                                        @if (isset($user->id) && $user->type === 'admin') selected @endif>Administrador da
                                                        Plataforma
                                                    </option>
                                                    <option value="partner"
                                                        @if (isset($user->id) && $user->type === 'partner') selected @endif>Sócio
                                                    </option>
                                                    <option value="collaborator"
                                                        @if (isset($user->id) && $user->type === 'collaborator') selected @endif>Colaborador
                                                    </option>
                                                    <option value="supplier"
                                                        @if (isset($user->id) && $user->type === 'supplier') selected @endif>Fornecedor
                                                    </option>
                                                    <option value="client"
                                                        @if (isset($user->id) && $user->type === 'client') selected @endif>Cliente
                                                    </option>
                                                </select>
                                                <div class="invalid-feedback"></div>
                                            </div>
                                        </div>
                                        <button type="submit" class="btn btn-primary">
                                            @if (isset($user->id))
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
