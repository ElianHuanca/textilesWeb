@extends('tablar::page')
@section('content')
    <!-- Page header -->
    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <h2 class="page-title">
                        Vista Almacen-Telas
                    </h2>
                </div>
            </div>
        </div>
    </div>
    <!-- Page body -->
    <div class="page-body">
        <div class="container-xl">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-body">
                            <div class="mb-3">
                                <label for="direccion" class="form-label">Direccion</label>
                                <input id="direccion" type="text"
                                    class="form-control @error('direccion') is-invalid @enderror" name="direccion"
                                    value="{{ $almacen->direccion }}" readonly>                                
                            </div>
                            <div class="mb-3">
                                <label for="zona" class="form-label">Zona</label>
                                <input id="zona" type="text"
                                    class="form-control @error('zona') is-invalid @enderror" name="zona"
                                    value="{{ $almacen->zona }}" readonly>                            
                            </div>
                            <div class="mb-3">
                                <label for="celular" class="form-label">Celular</label>
                                <input id="celular" type="text"
                                    class="form-control @error('celular') is-invalid @enderror" name="celular"
                                    value="{{ $almacen->celular }}" readonly>                                
                            </div>
                            <!-- Puedes agregar más campos según sea necesario -->
                            <a href="{{ route('almacenes.index') }}" class="btn btn-primary">Volver</a>
                        </div>
                        <div class="card-header">
                            <h3 class="card-title">Stock De Telas</h3>
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
                                        <th>NombreProducto</th>
                                        <th>Stock</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($almacen->almacenesTelas as $almacenTela)
                                        <tr>                     
                                            <td>
                                                <span class="text-muted">
                                                {{ $almacenTela->tela->id }}</span>
                                            </td>                       
                                            <td>
                                                <span class="flag flag-country-us"></span>
                                                {{ $almacenTela->tela->nombre }}
                                            </td>
                                            <td>
                                               {{$almacenTela->stock}}
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
