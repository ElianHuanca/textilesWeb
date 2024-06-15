@extends('tablar::page')

@section('content')
    <div class="container-xl">
        <div class="row justify-content-between align-items-center mb-3">
            <div class="col-auto">
                <h2 class="page-title">Usuarios</h2>
            </div>
            <div class="col-auto">
                <div class="btn-list">
                    <a href="{{ route('users.create') }}" class="btn btn-primary">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                            <line x1="12" y1="5" x2="12" y2="19" />
                            <line x1="5" y1="12" x2="19" y2="12" />
                        </svg>
                        Nuevo Usuario
                    </a>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Lista de usuarios</h3>
            </div>
            {{-- <div class="card-body border-bottom py-3">
                <div class="d-flex">
                    <div class="text-muted">
                        Show
                        <div class="mx-2 d-inline-block">
                            <input type="text" class="form-control form-control-sm" value="5" size="3" aria-label="Users count">
                        </div>
                        entries
                    </div>
                    <div class="ms-auto text-muted">
                        Search:
                        <div class="ms-2 d-inline-block">
                            <input type="text" class="form-control form-control-sm" aria-label="Search user">
                        </div>
                    </div>
                </div>
            </div> --}}
            <div class="table-responsive">
                <table class="table card-table table-vcenter text-nowrap datatable">
                    <thead>
                        <tr>                            
                            <th class="w-1">#</th>
                            <th>Nombre</th>
                            <th>Correo Electronico</th>
                            <th>Rol</th>
                            <th>Fecha Creacion</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $user)
                            <tr>                                
                                <td>{{ $user->id }}</td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>
                                    @switch($user->rol)
                                        @case(1)
                                            Gerente
                                            @break
                                        @case(2)
                                            Vendedor
                                            @break
                                        @case(3)
                                            Encargado de Almacén
                                            @break
                                        @default
                                            Desconocido
                                    @endswitch
                                </td>
                                <td>{{ $user->created_at }}</td>
                                <td>
                                    <a href="{{ route('users.edit', $user->id) }}" class="btn btn-sm btn-primary">Edit</a>
                                    <form action="{{ route('users.destroy', $user->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="card-footer d-flex align-items-center">
                <p class="m-0 text-muted">Showing {{ $users->firstItem() }} to {{ $users->lastItem() }} of {{ $users->total() }} entries</p>
                <ul class="pagination m-0 ms-auto">
                    @if ($users->onFirstPage())
                        <li class="page-item disabled">
                            <a class="page-link" href="#" tabindex="-1" aria-disabled="true">‹</a>
                        </li>
                    @else
                        <li class="page-item">
                            <a class="page-link" href="{{ $users->previousPageUrl() }}" tabindex="-1" aria-disabled="true">‹</a>
                        </li>
                    @endif
                    @foreach ($users->getUrlRange(1, $users->lastPage()) as $page => $url)
                        <li class="page-item {{ $page == $users->currentPage() ? 'active' : '' }}">
                            <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                        </li>
                    @endforeach
                    @if ($users->hasMorePages())
                        <li class="page-item">
                            <a class="page-link" href="{{ $users->nextPageUrl() }}">›</a>
                        </li>
                    @else
                        <li class="page-item disabled">
                            <a class="page-link" href="#" tabindex="-1" aria-disabled="true">›</a>
                        </li>
                    @endif
                </ul>
            </div>
        </div>
    </div>
@endsection
