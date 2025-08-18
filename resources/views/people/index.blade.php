@extends('layouts.app')

@section('title', 'People Management')

@section('content')
    <div class="container-fluid">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2>People Management</h2>
            <a href="{{ route('people.create') }}" class="btn btn-primary">
                <i class="fas fa-plus"></i> Add Person
            </a>
        </div>

        <!-- Filtros -->
        <div class="card mb-4">
            <div class="card-body">
                <form class="row g-3">
                    <div class="col-md-3">
                        <input type="text" class="form-control" placeholder="Search by name..." name="search">
                    </div>
                    <div class="col-md-2">
                        <select class="form-select" name="type">
                            <option value="">All Types</option>
                            <option value="client">Clients</option>
                            <option value="supplier">Suppliers</option>
                            <option value="employee">Employees</option>
                        </select>
                    </div>
                    <div class="col-md-2">
                        <button type="submit" class="btn btn-outline-primary w-100">
                            <i class="fas fa-filter"></i> Filter
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Listagem -->
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Type</th>
                                <th>Document</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($people as $person)
                                <tr>
                                    <td>{{ $person->id }}</td>
                                    <td>{{ $person->name }}</td>
                                    <td>
                                        @if ($person->is_client)
                                            <span class="badge bg-primary">Client</span>
                                        @endif
                                        @if ($person->is_supplier)
                                            <span class="badge bg-success">Supplier</span>
                                        @endif
                                        @if ($person->is_employee)
                                            <span class="badge bg-info">Employee</span>
                                        @endif
                                    </td>
                                    <td>{{ $person->document_formatted }}</td>
                                    <td>{{ $person->email ?? '-' }}</td>
                                    <td>{{ $person->phone ?? '-' }}</td>
                                    <td>
                                        <div class="d-flex gap-2">
                                            <a href="{{ route('people.edit', $person->id) }}"
                                                class="btn btn-sm btn-outline-primary">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <form action="{{ route('people.destroy', $person->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-outline-danger"
                                                    onclick="return confirm('Are you sure?')">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                            @if ($person->has_user_account)
                                                {{-- <a href="{{ route('users.edit', $person->userAccount->id) }}"
                                                    class="btn btn-sm btn-outline-secondary" title="Manage User Account">
                                                    <i class="fas fa-user-cog"></i> --}}
                                                </a>
                                            @else
                                                {{-- <a href="{{ route('users.create', ['person_id' => $person->id]) }}"
                                                    class="btn btn-sm btn-outline-success" title="Create User Account">
                                                    <i class="fas fa-user-plus"></i>
                                                </a> --}}
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Paginação -->
                <div class="d-flex justify-content-center mt-3">
                    {{ $people->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
