@extends('tablar::page')
@section('content')    
    <!-- Page header -->
    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <h2 class="page-title">
                        Vista Tela-telaes-Almacenes
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
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="nombre" class="form-label">Nombre</label>
                                    <input id="nombre" type="text" class="form-control" name="nombre"
                                        value="{{ $tela->nombre }}" readonly>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="precioxcompra" class="form-label">Costo Unitario</label>
                                    <input id="precioxcompra" type="text" class="form-control" name="precioxcompra"
                                        value="{{ number_format($tela->precioxcompra, 2) }}" readonly>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="rop" class="form-label">Rop</label>
                                    <input id="rop" type="text" class="form-control" name="rop"
                                        value="{{ number_format($tela->rop, 2) }}" readonly>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="seguridad" class="form-label">Stock De seguridad</label>
                                    <input id="seguridad" type="text" class="form-control" name="seguridad"
                                        value="{{ number_format($tela->seguridad, 2) }}" readonly>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="stock" class="form-label">Stock Total</label>
                                    <input id="stock" type="text" class="form-control" name="stock"
                                        value="{{ $tela->stock }}" readonly>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="precioxrollo" class="form-label">precioxrollo</label>
                                    <input id="precioxrollo" type="text" class="form-control" name="precioxrollo"
                                        value="{{ $tela->precioxrollo }}" readonly>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="precioxmay" class="form-label">Precio X Mayor</label>
                                    <input id="precioxmay" type="text" class="form-control" name="precioxmay"
                                        value="{{ $tela->precioxmay }}" readonly>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="precioxmen" class="form-label">precioxmen</label>
                                    <input id="precioxmen" type="text" class="form-control" name="precioxmen"
                                        value="{{ $tela->precioxmen }}" readonly>
                                </div>
                            </div>
                            <!-- Puedes agregar más campos según sea necesario -->
                            <a href="{{ route('telas.index') }}" class="btn btn-primary">Volver</a>
                        </div>
                        <div class="card-header">
                            <h3 class="card-title">Stock En Almacenes</h3>
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
                                        <th>Nombre Almacen</th>
                                        <th>Stock</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($alm as $almacen)
                                        <tr>
                                            <td>
                                                <span class="text-muted">
                                                    {{ $almacen->idalmacen }}</span>
                                            </td>
                                            <td>
                                                <span class="flag flag-country-us"></span>
                                                {{ $almacen->almacen->direccion }}
                                            </td>
                                            <td data-stocka="{{ $almacen->stock }}">
                                                {{ $almacen->stock }}
                                            </td>
                                        </tr>
                                    @endforeach
                                    <tr>
                                        <td colspan="2">
                                            Total
                                        </td>
                                        <td id="totala"></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="card-header">
                            <h3 class="card-title">Stock En Sucursales</h3>
                        </div>
                        <div class="table-responsive">
                            <table class="table card-table table-vcenter text-nowrap datatable">
                                <thead>
                                    <tr>
                                        <th class="w-1">#
                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                class="icon icon-sm text-dark icon-thick" width="24" height="24"
                                                viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                                fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                <polyline points="6 15 12 9 18 15" />
                                            </svg>
                                        </th>
                                        <th>Nombre Sucursal</th>
                                        <th>Stock</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($suc as $sucursal)
                                        <tr>
                                            <td>
                                                <span class="text-muted">
                                                    {{ $sucursal->idsucursal }}</span>
                                            </td>
                                            <td>
                                                <span class="flag flag-country-us"></span>
                                                {{ $sucursal->sucursal->direccion }}
                                            </td>
                                            <td data-stocks="{{ $sucursal->stock }}">
                                                {{ $sucursal->stock }}
                                            </td>
                                        </tr>                                        
                                    @endforeach
                                    <tr>
                                        <td colspan="2">
                                            Total
                                        </td>
                                        <td id="totals">                                            
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', (event) => {
            let totalStocks = 0;
            document.querySelectorAll('td[data-stocks]').forEach((cell) => {
                totalStocks += parseFloat(cell.getAttribute('data-stocks'));
            });
            document.getElementById('totals').textContent = totalStocks;

            let totalStocka = 0;
            document.querySelectorAll('td[data-stocka]').forEach((cell) => {
                totalStocka += parseFloat(cell.getAttribute('data-stocka'));
            });
            document.getElementById('totala').textContent = totalStocka;
        });
    </script>
@endsection
