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
                                    <form class="form-validation" method="POST"
                                          action="{{ isset($user) ? route('users.update', $user->id) : route('users.store') }}">
                                        @csrf
                                        @if(isset($user)) @method('PUT') @endif

                                        <input type="hidden" name="id" value="{{ $user->id ?? '' }}" />

                                        <!-- Seção de Dados Básicos -->
                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label for="name">Nome Completo</label>
                                                <input type="text" name="name" id="name"
                                                    value="{{ old('name', $user->name ?? '') }}"
                                                    class="form-control required-validation">
                                                <div class="invalid-feedback"></div>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="email">Email</label>
                                                <input type="email" name="email" id="email"
                                                    value="{{ old('email', $user->email ?? '') }}"
                                                    class="form-control required-validation">
                                                <div class="invalid-feedback"></div>
                                            </div>
                                        </div>

                                        <!-- Seção de Senha -->
                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label for="password">Senha</label>
                                                <input type="password" name="password" id="password"
                                                    class="form-control confirm-validation @if (!isset($user->id)) required-validation @endif">
                                                <div class="invalid-feedback"></div>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="password_confirmation">Confirmação de Senha</label>
                                                <input type="password" name="password_confirmation"
                                                    id="password_confirmation"
                                                    class="form-control confirm-compare-validation @if (!isset($user->id)) required-validation @endif">
                                                <div class="invalid-feedback"></div>
                                            </div>
                                        </div>

                                        <!-- Seção de Vinculação com Pessoa -->
                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label for="person_id">Vincular à Pessoa Existente</label>
                                                <select class="custom-select" id="person_id" name="person_id">
                                                    <option value="">-- Não vincular --</option>
                                                    @foreach($people as $person)
                                                        <option value="{{ $person->id }}"
                                                            {{ old('person_id', $user->person_id ?? '') == $person->id ? 'selected' : '' }}>
                                                            {{ $person->name }} ({{ $person->document_formatted ?? 'Sem documento' }})
                                                        </option>
                                                    @endforeach
                                                </select>
                                                @if(isset($person))
                                                    <small class="text-muted">Vinculando à pessoa: {{ $person->name }}</small>
                                                @endif
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="type">Tipo de Usuário</label>
                                                <select class="custom-select required-validation" id="type" name="type">
                                                    <option selected disabled>Selecione</option>
                                                    <option value="admin" {{ (old('type', $user->type ?? '') == 'admin' ? 'selected' : '' }}>Administrador</option>
                                                    <option value="seller" {{ (old('type', $user->type ?? '') == 'seller' ? 'selected' : '' }}>Vendedor</option>
                                                    <option value="default" {{ (old('type', $user->type ?? '') == 'default' ? 'selected' : '' }}>Usuário Comum</option>
                                                </select>
                                                <div class="invalid-feedback"></div>
                                            </div>
                                        </div>

                                        <!-- Botões de Ação -->
                                        <div class="form-row mt-4">
                                            <div class="col-md-12 text-right">
                                                <a href="{{ route('users.index') }}" class="btn btn-secondary mr-2">Cancelar</a>
                                                <button type="submit" class="btn btn-primary">
                                                    @if (isset($user->id))
                                                        Atualizar
                                                    @else
                                                        Cadastrar
                                                    @endif
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div> <!-- /.card-body -->
                            </div> <!-- /.card -->
                        </div> <!-- /.col -->
                    </div> <!-- /.end-section -->
                </div> <!-- .col-12 -->
            </div> <!-- .row -->
        </div> <!-- .container-fluid -->
    </main> <!-- main -->
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {


        @if(isset($person))
            document.getElementById('person_id').disabled = true;
        @endif
    });
</script>
@endsection
