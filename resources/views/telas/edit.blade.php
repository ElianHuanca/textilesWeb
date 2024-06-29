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
                                    <label for="precioxmen" class="form-label">Precio Menor</label>
                                    <input id="precioxmen" type="text" class="form-control @error('precioxmen') is-invalid @enderror" name="precioxmen" value="{{ $tela->precioxmen }}" required>
                                    @error('precioxmen')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>                                
                                <div class="mb-3">
                                    <label for="precioxmay" class="form-label">Precio Mayor</label>
                                    <input id="precioxmay" type="text" class="form-control @error('precioxmay') is-invalid @enderror" name="precioxmay" value="{{ $tela->precioxmay }}" required>
                                    @error('precioxmay')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="precioxrollo" class="form-label">Precio Rollo</label>
                                    <input id="precioxrollo" type="text" class="form-control @error('precioxrollo') is-invalid @enderror" name="precioxrollo" value="{{ $tela->precioxrollo }}" required>
                                    @error('precioxrollo')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                {{-- <div class="mb-3">
                                    <label for="precioxcompra" class="form-label">Precio de Compra</label>
                                    <input id="precioxcompra" type="text" class="form-control @error('precioxcompra') is-invalid @enderror" name="precioxcompra" value="{{ $tela->precioxcompra }}" required>
                                    @error('precioxcompra')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div> --}}
                                <div class="mb-3">
                                    <label for="proveedor" class="form-label">Proveedores</label>
                                    <select id="proveedor" class="form-control @error('proveedor') is-invalid @enderror" name="idproveedor" required>
                                        <option value="{{$tela->proveedor->id}}" selected>{{$tela->proveedor->nombre}}</option>
                                        @foreach($proveedores as $proveedor)
                                            <option value="{{ $proveedor->id }}"> {{-- {{ $tela->idproveedor == $proveedor->id ? 'selected' : '' }}> --}}
                                                {{ $proveedor->nombre }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('proveedor')
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
