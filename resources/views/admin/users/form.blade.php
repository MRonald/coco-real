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
                                            <div class="form-group col-md-12">
                                                <label for="name">Nome</label>
                                                <input type="text" name="name" id="name"
                                                    value="{{ $user->name ?? '' }}"
                                                    class="form-control required-validation">
                                                <div class="invalid-feedback"></div>
                                            </div>

                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-md-12">
                                                <label for="email">Email</label>
                                                <input type="email" name="email" id="email"
                                                    value="{{ $user->email ?? '' }}"
                                                    class="form-control required-validation">
                                                <div class="invalid-feedback"></div>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label for="password">Senha</label>
                                                <input type="password" name="password" id="password"
                                                    class="form-control confirm-validation @if (!isset($user->id)) required-validation @endif">
                                                <div class="invalid-feedback"></div>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="password_confirmation">Confirmação de senha</label>
                                                <input type="password" name="password_confirmation"
                                                    id="password_confirmation"
                                                    class="form-control confirm-compare-validation @if (!isset($user->id)) required-validation @endif">
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
                                                        @if (isset($user->id) && $user->type === 'admin') selected @endif>Administrador
                                                    </option>
                                                    <option value="seller"
                                                        @if (isset($user->id) && $user->type === 'seller') selected @endif>Vendedor</option>
                                                    <option value="default"
                                                        @if (isset($user->id) && $user->type === 'default') selected @endif>Usuário comum
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
