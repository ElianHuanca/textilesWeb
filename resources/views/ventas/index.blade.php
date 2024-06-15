@extends('tablar::page')

@section('content')    
    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">                    
                    <div class="page-pretitle">
                        Overview
                    </div>
                    <h2 class="page-title">
                        Ventas
                    </h2>
                </div>                
                <div class="col-12 col-md-auto ms-auto d-print-none">
                    <a href="{{ route('ventas.create') }}" class="btn btn-primary d-none d-sm-inline-block">                        
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                            viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
                            stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            <line x1="12" y1="5" x2="12" y2="19" />
                            <line x1="5" y1="12" x2="19" y2="12" />
                        </svg>
                        Crear Nueva Venta
                    </a>                    
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
                            <h3 class="card-title">Listado De Ventas</h3>
                        </div>
                        <div class="table-responsive">
                            <table class="table card-table table-vcenter text-nowrap datatable">
                                <thead>
                                    <tr>
                                        <th class="w-1">#
                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                class="icon icon-sm text-dark icon-thick" width="24" height="24"
                                                viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                                stroke-linecap="round" stroke-linejoin="round">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                <polyline points="6 15 12 9 18 15" />
                                            </svg>
                                        </th>
                                        <th>Fecha</th>
                                        <th>Total</th>
                                        <th>Ganancias</th>
                                        <th>Descuento</th>                                        
                                        <th>Sucursal</th>                                        
                                        <th>Vendedor</th>                                        
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($ventas as $venta)
                                        <tr>
                                            <td><span class="text-muted">{{ $venta->id }}</span></td>
                                            <td>                                                
                                                {{ $venta->fecha }}
                                            </td>
                                            <td>                                                
                                                {{ $venta->total }}
                                            </td>
                                            <td>                                                
                                                {{ $venta->ganancias }}
                                            </td>
                                            <td>                                                
                                                {{ $venta->descuento }}
                                            </td>
                                            <td>                                                
                                                {{ $venta->sucursal->direccion }}
                                            </td>
                                            <td>                                                
                                                {{ $venta->usuario->name }}
                                            </td>
                                            <td>
                                                <a href="{{ route('ventas.show', $venta->id) }}" title="Ver">
                                                    <i class="ti ti-eye"></i>
                                                </a>
                                                <a href="{{ route('ventas.edit', $venta) }}" title="Editar">
                                                    <i class="ti ti-edit"></i>
                                                </a>
                                                <form action="{{ route('ventas.destroy', $venta->id) }}" method="POST" style="display:inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" title="Eliminar" onclick="return confirm('¿Estás seguro de eliminar este elemento?');" style="background:none; border:none; padding:0; margin:0; cursor:pointer;">
                                                        <i class="ti ti-trash" style="color: #0054a6"></i>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
