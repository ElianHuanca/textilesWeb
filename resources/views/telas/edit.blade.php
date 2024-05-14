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
                        Editar Tela
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
                            <form method="POST" action="{{ route('telas.update', $tela->id) }}">
                                @csrf
                                @method('PUT')
                                <div class="mb-3">
                                    <label for="nombre" class="form-label">Nombre</label>
                                    <input id="nombre" type="text" class="form-control @error('nombre') is-invalid @enderror" name="nombre" value="{{ $tela->nombre }}" required autofocus>
                                    @error('nombre')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="precioCompra" class="form-label">Precio de Compra</label>
                                    <input id="precioCompra" type="text" class="form-control @error('precioCompra') is-invalid @enderror" name="precioCompra" value="{{ $tela->precioCompra }}" required>
                                    @error('precioCompra')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="precioMayor" class="form-label">Precio Mayor</label>
                                    <input id="precioMayor" type="text" class="form-control @error('precioMayor') is-invalid @enderror" name="precioMayor" value="{{ $tela->precioMayor }}" required>
                                    @error('precioMayor')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="precioMenor" class="form-label
                                    ">Precio Menor</label>
                                    <input id="precioMenor" type="text" class="form-control @error('precioMenor') is-invalid @enderror" name="precioMenor" value="{{ $tela->precioMenor }}" required>
                                    @error('precioMenor')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="precioRollo" class="form-label">Precio Rollo</label>
                                    <input id="precioRollo" type="text" class="form-control @error('precioRollo') is-invalid @enderror" name="precioRollo" value="{{ $tela->precioRollo }}" required>
                                    @error('precioRollo')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <button type="submit" class="btn btn-primary">Actualizar</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
