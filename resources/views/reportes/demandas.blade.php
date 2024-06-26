<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Demanda De Telas</title>
</head>

<body>
    <div class="page-body">
        <div class="container-xl">
            <div class="row row-deck row-cards">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Lista de telas</h3>
                        </div>
                        <div class="table-responsive">
                            <table class="table card-table table-vcenter text-nowrap datatable">
                                <thead>
                                    <tr>
                                        {{-- <th class="w-1"><input class="form-check-input m-0 align-middle" type="checkbox"
                                                aria-label="Select all telas"></th> --}}
                                        <th class="w-1">#
                                            <!-- Icono de orden -->
                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                class="icon icon-sm text-dark icon-thick" width="24" height="24"
                                                viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                                fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                <polyline points="6 15 12 9 18 15" />
                                            </svg>
                                        </th>
                                        <th>Nombre</th>
                                        <th>Precio Menor</th>
                                        <th>Precio Mayor</th>
                                        <th>Precio Rollo</th>
                                        <th>Costo Unitario</th>
                                        <th>Proveedor</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($telas as $tela)
                                        <tr>
                                            <td>{{ $tela->id }}</td>
                                            <td>{{ $tela->nombre }}</td>
                                            <td>{{ $tela->precioxmen }}</td>
                                            <td>{{ $tela->precioxmay }}</td>
                                            <td>{{ $tela->precioxrollo }}</td>
                                            <td>{{ $tela->precioxcompra }}</td>
                                            {{-- <td>{{ $tela->rop }}</td> --}}
                                            {{-- <td>{{ $tela->stockseguridad }}</td> --}}
                                            <td>{{ $tela->proveedor->nombre }}</td>
                                            <td>
                                                <a href="{{ route('telas.show', $tela->id) }}" title="Ver">
                                                    <i class="ti ti-eye"></i>
                                                </a>
                                                <a href="{{ route('telas.edit', $tela) }}" title="Editar">
                                                    <i class="ti ti-edit"></i>
                                                </a>
                                                <form action="{{ route('telas.destroy', $tela->id) }}" method="POST"
                                                    style="display:inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" title="Eliminar"
                                                        onclick="return confirm('¿Estás seguro de eliminar este elemento?');"
                                                        style="background:none; border:none; padding:0; margin:0; cursor:pointer;">
                                                        <i class="ti ti-trash" style="color: #0054a6"></i>
                                                    </button>
                                                </form>
                                                {{-- <a href="{{ route('telas.edit', $tela->id) }}"
                                                    class="btn btn-sm btn-primary">Edit</a>
                                                    <form action="{{ route('telas.destroy', $tela->id) }}" method="POST" class="d-inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                                    </form> --}}

                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="card-footer d-flex align-items-center">
                            <p class="m-0 text-muted">Mostrando {{ $telas->firstItem() }} a {{ $telas->lastItem() }}
                                de
                                {{ $telas->total() }} registros</p>
                            <ul class="pagination m-0 ms-auto">
                                @if ($telas->onFirstPage())
                                    <li class="page-item disabled">
                                        <a class="page-link" href="#" tabindex="-1" aria-disabled="true">‹</a>
                                    </li>
                                @else
                                    <li class="page-item">
                                        <a class="page-link" href="{{ $telas->previousPageUrl() }}" tabindex="-1"
                                            aria-disabled="true">‹</a>
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
</body>

</html>
