@extends('layouts.admin')

@section('content')
    <main role="main" class="main-content">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-12">
                    <h2 class="mb-2 page-title">Lista de
                        @if (Route::is('users.collaborators'))
                            <th>Colaboradores</th>
                        @else
                            <th>Usuários</th>
                        @endif
                    </h2>
                    <div class="row my-4">
                        <!-- Small table -->
                        <div class="col-md-12">
                            <div class="card shadow">
                                <div class="card-body">
                                    <!-- table -->
                                    <table class="table datatables" id="dataTable-1">
                                        <thead>
                                            <tr>
                                                <th>Id</th>
                                                <th>Nome</th>
                                                <th>Email</th>
                                                @if (Route::is('users.collaborators'))
                                                    <th>Cargo</th>
                                                @else
                                                    <th>Tipo</th>
                                                @endif
                                                <th>Ações</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($users as $user)
                                                <tr>
                                                    <td>{{ $user->id }}</td>
                                                    <td>{{ $user->name }}</td>
                                                    <td>{{ $user->email }}</td>
                                                    @if (Route::is('users.collaborators'))
                                                        <th>{{ $user->role->name }}</th>
                                                    @else
                                                        <td>{{ $user->translated_type }}</td>
                                                    @endif
                                                    <td>
                                                        <button class="btn btn-sm dropdown-toggle more-horizontal"
                                                            type="button" data-toggle="dropdown" aria-haspopup="true"
                                                            aria-expanded="false">
                                                        </button>
                                                        <div class="dropdown-menu dropdown-menu-right">
                                                            <a class="dropdown-item"
                                                                href="{{ route('users.edit', $user->id) }}">Editar</a>
                                                            <a class="dropdown-item" id="btnModalDelete" href="#"
                                                                data-item-id="{{ $user->id }}" data-toggle="modal"
                                                                data-target="#confirmDeleteUser">Excluir</a>
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

    <!-- Modal confirm delete user -->
    <div class="modal fade" id="confirmDeleteUser" tabindex="-1" role="dialog" aria-labelledby="verticalModalTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="verticalModalTitle">Excluir usuário</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">Tem certeza que deseja excluir este usuário da plataforma?</div>
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
            $('#btnConfirmDelete').attr('href', `/admin/users/${$(this).data('item-id')}/delete`);
        });
    </script>
@endsection
