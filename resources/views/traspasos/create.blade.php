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
                        Realizar Traspasos
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
                            <form method="POST" action="{{ route('traspasos.store') }}">
                                @csrf
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="almacen" class="form-label">Almacen Origen</label>
                                        <select id="almacen" class="form-control @error('almacen') is-invalid @enderror"
                                            name="idalmacen" required>
                                            <option value="0">Seleccione un almacen</option>
                                            @foreach ($almacenes as $almacen)
                                                <option value="{{ $almacen->id }}">
                                                    {{ $almacen->direccion }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('almacen')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="sucursal" class="form-label">Sucursal Destino</label>
                                        <select id="sucursal" class="form-control @error('sucursal') is-invalid @enderror"
                                            name="idsucursal" required>
                                            <option value="0">Seleccione un sucursal</option>
                                            @foreach ($sucursales as $sucursal)
                                                <option value="{{ $sucursal->id }}">
                                                    {{ $sucursal->direccion }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('sucursal')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <h2 style="text-align: center; padding-top: 20px">Detalles del Traspaso</h2>
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="tela" class="form-label">Tela</label>
                                        <select id="tela" class="form-control @error('tela') is-invalid @enderror"
                                            name="idtela" required>
                                            <option value="0">Seleccione una tela</option>
                                            @foreach ($telas as $tela)
                                                <option value="{{ $tela->id }}">
                                                    {{ $tela->nombre }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('tela')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="cantidad" class="form-label">cantidad</label>
                                        <div class="input-group">
                                            <input id="cantidad" type="text"
                                                class="form-control @error('cantidad') is-invalid @enderror" name="cantidad"
                                                value="" autofocus>
                                            <div class="input-group-append">
                                                <span class="input-group-text">mts</span>
                                            </div>
                                        </div>
                                        @error('cantidad')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="stocka" class="form-label">Stock Almacen</label>
                                        <div class="input-group">
                                            <input id="stocka" type="text"
                                                class="form-control @error('stocka') is-invalid @enderror" name="stocka"
                                                value="" readonly>
                                            <div class="input-group-append">
                                                <span class="input-group-text">mts</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="stocks" class="form-label">Stock Sucursal</label>
                                        <div class="input-group">
                                            <input id="stocks" type="text" class="form-control" name="stocks"
                                                value="" readonly>
                                            <div class="input-group-append">
                                                <span class="input-group-text">mts</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <button type="button" class="btn btn-primary" id="agregar-tela">Agregar</button>
                                <input type="hidden" id="telas" name="telas">
                                <table class="table mt-3">
                                    <thead>
                                        <tr>
                                            <th>Nombre Tela</th>
                                            <th>Cantidad</th>
                                            <th>Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody id="tabla-telas">
                                    </tbody>
                                </table>
                                <button type="submit" class="btn btn-primary">Guardar</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const telaSelect = document.getElementById('tela');
            const almacenSelect = document.getElementById('almacen');
            const sucursalSelect = document.getElementById('sucursal');
            const cantidadInput = document.getElementById('cantidad');
            const stockaInput = document.getElementById('stocka');
            const stocksInput = document.getElementById('stocks');
            const agregarTelaButton = document.getElementById('agregar-tela');
            const telasInput = document.getElementById('telas');
            const tablaTelas = document.getElementById('tabla-telas');
            var telasSucursales = @json($telasSucursales);
            var telasAlmacenes = @json($telasAlmacenes);

            function vaciarInputs() {
                telaSelect.value = '0';
                cantidadInput.value = '';
                stockaInput.value = '';
                stocksInput.value = '';
            }

            function eventTelaSelectChange() {
                const idtela = telaSelect.value;
                const idsucursal = sucursalSelect.value;
                const idalmacen = almacenSelect.value;
                if (idtela == 0) {
                    stockaInput.value = '';
                    stocksInput.value = '';
                    return;
                }

                stockaInput.value = telasAlmacenes.find(tela => tela.idtela == idtela && tela.idalmacen ==
                    idalmacen).stock;
                stocksInput.value = telasSucursales.find(tela => tela.idtela == idtela && tela.idsucursal ==
                    idsucursal).stock;
            }

            telaSelect.addEventListener('change', eventTelaSelectChange);

            function cambioDeSucursal() {
                const idsucursal = sucursalSelect.value;
                const idalmacen = almacenSelect.value;
                if (idsucursal == 0 || idalmacen == 0) {
                    telaSelect.disabled = true;
                } else {
                    telaSelect.disabled = false;
                }
            }

            function cambioDeAlmancen() {
                cambioDeSucursal();
                eliminarTelas();     
                vaciarInputs();           
            }
            cambioDeSucursal();
            sucursalSelect.addEventListener('change', cambioDeSucursal);
            almacenSelect.addEventListener('change', cambioDeAlmancen);

            function validarDatos(idtela, cantidad, stocka) {
                if (cantidad == '' ) {
                    alert('Inserte Una Cantidad');
                    return true;
                }
                if (idtela == 0 || cantidad == 0) {
                    alert('Seleccione una tela y/o una cantidad');
                    return true;
                }
                if (parseFloat(cantidad) > parseFloat(stocka)) {
                    alert('La cantidad no puede ser mayor al stock del almacen');
                    return true;
                }
                return false;
            }

            function eliminarTelas() {
                let telas = [];
                if (telasInput.value) {
                    try {
                        telas = JSON.parse(telasInput.value);
                    } catch (e) {
                        console.error("Error parsing JSON:", e);
                        telas = [];
                    }
                }

                telas.splice(0, telas.length);
                telasInput.value = JSON.stringify(telas);
                tablaTelas.innerHTML = '';
            }


            function agregarTela() {
                const idtela = telaSelect.value;
                const tela = telaSelect.options[telaSelect.selectedIndex].text;
                const cantidad = cantidadInput.value;
                const stocka = stockaInput.value;
                const stocks = stocksInput.value;
                if (validarDatos(idtela, cantidad, stocka)) {
                    return;
                }

                const nuevaFila = document.createElement('tr');

                nuevaFila.innerHTML = `
                    <td>${tela}</td>                    
                    <td>${cantidad}</td>
                    <td>
                        <button type="button" class="btn btn-danger btn-sm borrar-fila">Eliminar</button>
                    </td>
                `;

                tablaTelas.appendChild(nuevaFila);

                const telas = JSON.parse(telasInput.value);

                telas.push({
                    idtela,
                    cantidad
                });
                telasInput.value = JSON.stringify(telas);

                nuevaFila.querySelector('.borrar-fila').addEventListener('click', function() {
                    const telas = JSON.parse(telasInput.value);
                    const index = telas.findIndex(tela => tela.idtela == idtela);
                    telas.splice(index, 1);
                    telasInput.value = JSON.stringify(telas);
                    nuevaFila.remove();
                });

                vaciarInputs();
            }
            agregarTelaButton.addEventListener('click', agregarTela);
        });
    </script>
@endsection
