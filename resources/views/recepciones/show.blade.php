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
                        Compra Recepcionada
                    </h2>
                </div>
            </div>
        </div>
    </div>
    <!-- Page body -->
    <div class="page-body">
        <div class="container-xl">
            <div class="row justify-content-center">
                <div class="col-md-10">
                    <div class="card">
                        <div class="card-body">                            
                                <h2 style="text-align: center; padding-top: 20px">Compra</h2>                                
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="fechac" class="form-label">fecha compra</label>
                                        <input id="fechac" type="date" class="form-control" name="fechac"
                                            value="{{ $compra->fecha }}" readonly>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="proveedor" class="form-label">proveedor</label>
                                        <input id="proveedor" type="text" class="form-control" name="proveedor"
                                            value="{{ $compra->proveedor->nombre }}" readonly>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="total" class="form-label">total</label>
                                        <input id="total" type="text" class="form-control" name="total"
                                            value="{{ $compra->total }}" readonly>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="totalag" class="form-label">total gastos</label>
                                        <input id="totalag" type="text" class="form-control" name="totalag"
                                            value="{{ $compra->totalag }}" readonly>
                                    </div>
                                </div>
                                <h2 style="text-align: center; padding-top: 20px">Detalle De Compra</h2>
                                <input type="hidden" id="telas" name="telas">
                                <table class="table mt-3">
                                    <thead>
                                        <tr>
                                            <th hidden>ID</th>
                                            <th>Nombre Tela</th>
                                            <th>Precio Compra</th>
                                            <th>Cantidad</th>
                                            <th>Importe</th>
                                            <th>Importe Gastos</th>
                                        </tr>
                                    </thead>
                                    <tbody class="tabla-telas">
                                        @foreach ($detcompras as $detalle)
                                            <tr>
                                                <td hidden>{{ $detalle->idtela }}</td>
                                                <td>{{ $detalle->tela->nombre }}</td>
                                                <td>{{ $detalle->precio }}</td>
                                                <td>{{ $detalle->cantidad }}</td>
                                                <td>{{ $detalle->total }}</td>
                                                <td>{{ $detalle->totalag }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <h2 style="text-align: center; padding-top: 20px">Recepcion De Compra</h2>
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="fecha" class="form-label">Fecha Recepcion</label>
                                        <input id="fecha" type="date" class="form-control" name="fecha"
                                            value="{{ $recepcion->fecha}}" readonly>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="tiempo" class="form-label">Tiempo Entrega</label>
                                        <input id="tiempo" type="text" class="form-control" name="tiempo"
                                            value="{{ $recepcion->tiempo}}" readonly>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="almacen" class="form-label">Almacen Destino</label>
                                    <input id="almacen" type="text" class="form-control" name="almacen"
                                        value="{{ $recepcion->almacen->direccion}}" readonly>
                                </div>
                                <a href="{{ route('recepciones.index') }}" class="btn btn-primary">Volver</a>                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>    
@endsection
