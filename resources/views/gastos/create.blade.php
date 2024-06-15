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
                        Adicionar Gastos
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
                            <form method="POST" action="{{ route('gastos.store') }}">
                                @csrf
                                @method('PUT')
                                <h2 style="text-align: center; padding-top: 20px">Compra</h2>
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="fecha" class="form-label">fecha</label>
                                        <input id="fecha" type="text" class="form-control" name="fecha" value="{{ $compra->fecha }}" readonly>                                    
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="proveedor" class="form-label">proveedor</label>
                                        <input id="proveedor" type="text" class="form-control" name="proveedor" value="{{ $compra->proveedor->nombre }}" readonly>                                    
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="total" class="form-label">total</label>
                                        <input id="total" type="text" class="form-control" name="total" value="{{ $compra->total }}" readonly>                                    
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="total" class="form-label">total adicion de gastos</label>
                                        <input id="total" type="text" class="form-control" name="total" value="{{ $compra->totalag }}" readonly>                                    
                                    </div>
                                </div>
                                

                                <!-- Puedes agregar más campos según sea necesario -->
                                <button type="submit" class="btn btn-primary">Guardar</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection