@extends('layouts.admin')

@section('content')
    <main role="main" class="main-content">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-12">
                    <h2 class="page-title">
                        @if (isset($role->id))
                            Editar
                        @else
                            Criar
                        @endif
                        Cargo
                    </h2>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card shadow mb-4">
                                <div class="card-body">
                                    <form class="form-validation" method="POST" action="{{ route('roles.store') }}">
                                        @csrf
                                        <input type="hidden" name="id" value="{{ $role->id ?? '' }}" />

                                        <div class="form-row">
                                            <div class="form-group col-md-12">
                                                <label for="name">Nome</label>
                                                <input type="text" name="name" id="name"
                                                    value="{{ $role->name ?? '' }}"
                                                    class="form-control required-validation">
                                                <div class="invalid-feedback"></div>
                                            </div>
                                        </div>

                                        <button type="submit" class="btn btn-primary">
                                            @if (isset($role->id))
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
