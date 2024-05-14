@extends('tablar::page')

@section('content')
    <!-- Page header -->
    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <!-- Page pre-title -->
                    <div class="page-pretitle">
                        Overview
                    </div>
                    <h2 class="page-title">
                        Telas
                    </h2>
                </div>
                <!-- Page title actions -->
                <div class="col-12 col-md-auto ms-auto d-print-none">
                    <div class="btn-list">
                        <!-- Botón para registrar una nueva tela -->
                        <a href="{{ route('telas.create') }}" class="btn btn-primary">
                            <!-- Icono de agregar tela -->
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                                viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <line x1="12" y1="5" x2="12" y2="19" />
                                <line x1="5" y1="12" x2="19" y2="12" />
                            </svg>
                            Nueva Tela
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Page body -->
    <div class="page-body">
        <div class="container-xl">
            <div class="row row-deck row-cards">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Lista de telas</h3>
                        </div>
                        <div class="card-body border-bottom py-3">
                            <div class="d-flex">
                                <div class="text-muted">
                                    Show
                                    <div class="mx-2 d-inline-block">
                                        <input type="text" class="form-control form-control-sm" value="5" size="3"
                                            aria-label="Telas count">
                                    </div>
                                    entries
                                </div>
                                <div class="ms-auto text-muted">
                                    Search:
                                    <div class="ms-2 d-inline-block">
                                        <input type="text" class="form-control form-control-sm"
                                            aria-label="Search tela">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table card-table table-vcenter text-nowrap datatable">
                                <thead>
                                    <tr>
                                        <th class="w-1"><input class="form-check-input m-0 align-middle" type="checkbox"
                                                aria-label="Select all telas"></th>
                                        <th class="w-1">No.
                                            <!-- Icono de orden -->
                                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-sm text-dark icon-thick"
                                                width="24" height="24" viewBox="0 0 24 24" stroke-width="2"
                                                stroke="currentColor" fill="none" stroke-linecap="round"
                                                stroke-linejoin="round">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                <polyline points="6 15 12 9 18 15" />
                                            </svg>
                                        </th>
                                        <th>Nombre</th>
                                        <th>Precio de Compra</th>
                                        <th>Precio Mayor</th>
                                        <th>Precio Menor</th>
                                        <th>Precio Rollo</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- Iterar sobre la lista de telas y mostrarlas en filas de la tabla -->
                                    @foreach($telas as $tela)
                                        <tr>
                                            <td><input class="form-check-input m-0 align-middle" type="checkbox"
                                                    aria-label="Select tela"></td>
                                            <td><span class="text-muted">{{ $loop->iteration }}</span></td>
                                            <td>{{ $tela->nombre }}</td>
                                            <td>{{ $tela->precioCompra }}</td>
                                            <td>{{ $tela->precioMayor }}</td>
                                            <td>{{ $tela->precioMenor }}</td>
                                            <td>{{ $tela->precioRollo }}</td>
                                            <td>
                                                <!-- Enlaces o botones para acciones como editar o eliminar telas -->
                                                <a href="{{ route('telas.edit', $tela->id) }}"
                                                    class="btn btn-sm btn-primary">Edit</a>
                                                    <form action="{{ route('telas.destroy', $tela->id) }}" method="POST" class="d-inline">
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
                            <p class="m-0 text-muted">Showing {{ $telas->firstItem() }} to {{ $telas->lastItem() }} of {{ $telas->total() }} entries</p>
                            <ul class="pagination m-0 ms-auto">
                                @if ($telas->onFirstPage())
                                    <li class="page-item disabled">
                                        <a class="page-link" href="#" tabindex="-1" aria-disabled="true">‹</a>
                                    </li>
                                @else
                                    <li class="page-item">
                                        <a class="page-link" href="{{ $telas->previousPageUrl() }}" tabindex="-1" aria-disabled="true">‹</a>
                                    </li>
                                @endif
                        
                                @foreach ($telas->getUrlRange(1, $telas->lastPage()) as $page => $url)
                                    <li class="page-item {{ $page == $telas->currentPage() ? 'active' : '' }}">
                                        <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                                    </li>
                                @endforeach
                        
                                @if ($telas->hasMorePages())
                                    <li class="page-item">
                                        <a class="page-link" href="{{ $telas->nextPageUrl() }}">›</a>
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
            </div>
        </div>
    </div>
@endsection
