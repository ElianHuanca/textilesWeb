@extends('tablar::page')

@section('content')
    <!-- Page header -->
    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <h2 class="page-title">
                        Crear Venta
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
                            <form method="POST" action="{{ route('ventas.store') }}">
                                @csrf
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="fecha" class="form-label">fecha</label>
                                        <input id="fecha" type="date"
                                            class="form-control @error('fecha') is-invalid @enderror" name="fecha"
                                            value="{{ old('fecha') }}" required autofocus>
                                        @error('fecha')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="descuento" class="form-label">descuento</label>
                                        <div class="input-group">
                                            <input id="descuento" type="text"
                                                class="form-control @error('descuento') is-invalid @enderror"
                                                name="descuento" value="" autofocus>
                                            <div class="input-group-append">
                                                <span class="input-group-text">Bs</span>
                                            </div>
                                        </div>
                                        @error('descuento')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="sucursal" class="form-label">sucursales</label>
                                        <select id="sucursal" class="form-control @error('sucursal') is-invalid @enderror"
                                            name="idsucursal" required>
                                            <option value="0">Seleccione una sucursal</option>
                                            @foreach ($sucursales as $sucursal)
                                                <option value="{{ $sucursal->id }}"
                                                    {{ old('sucursal') == $sucursal->id ? 'selected' : '' }}>
                                                    {{ $sucursal->direccion }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="total" class="form-label">total</label>
                                        <div class="input-group">
                                            <input id="total" type="text"
                                                class="form-control @error('total') is-invalid @enderror" name="total"
                                                value="0" readonly>
                                            <div class="input-group-append">
                                                <span class="input-group-text">Bs</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <br>
                                <h2 style="text-align: center; padding-top: 20px">Detalles de la venta</h2>
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="tela" class="form-label">Tela</label>
                                        <select id="tela" class="form-control @error('tela') is-invalid @enderror"
                                            name="idtela">
                                            <option value="0">Seleccione una tela</option>
                                            @foreach ($telas as $tela)
                                                <option value="{{ $tela->id }}" data-precio="{{ $tela->precioxcompra }}"
                                                    data-nombre="{{ $tela->nombre }}" data-id="{{ $tela->id }}"
                                                    {{ old('tela') == $tela->id ? 'selected' : '' }}>
                                                    {{ $tela->nombre }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="precioxcompra" class="form-label">Precio Compra</label>
                                        <div class="input-group">
                                            <input id="precioxcompra" type="text"
                                                class="form-control @error('precioxcompra') is-invalid @enderror"
                                                name="precioxcompra" value="{{ old('precioxcompra') }}" readonly autofocus>
                                            <div class="input-group-append">
                                                <span class="input-group-text">Bs</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="precio" class="form-label">Precio Venta</label>
                                        <input id="precio" type="text"
                                            class="form-control @error('precio') is-invalid @enderror" name="precio"
                                            value="{{ old('precio') }}" autofocus>
                                        @error('precio')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="cantidad" class="form-label">Cantidad</label>
                                        <input id="cantidad" type="text"
                                            class="form-control @error('cantidad') is-invalid @enderror" name="cantidad"
                                            value="{{ old('cantidad') }}" autofocus>
                                        @error('cantidad')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <button type="button" class="btn btn-primary" id="agregar-tela">Agregar</button>
                                <br>

                                <input type="hidden" id="telas" name="telas">

                                <table class="table mt-3">
                                    <thead>
                                        <tr>
                                            <th>Nombre Tela</th>
                                            <th>Precio Venta</th>
                                            <th>Cantidad</th>
                                            <th>Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody id="tabla-telas">
                                    </tbody>
                                </table>
                                <button type="submit" class="btn btn-primary">Registrar Venta</button>
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
            const precioInput = document.getElementById('precioxcompra');
            const precioVentaInput = document.getElementById('precio');
            const cantidadInput = document.getElementById('cantidad');
            const agregarButton = document.getElementById('agregar-tela');
            const tablaTelas = document.getElementById('tabla-telas');
            const telasInput = document.getElementById('telas');
            const form = document.querySelector('form');
            const totalInput = document.getElementById('total');
            const almacenSelect = document.getElementById('almacen');
            const sucursalSelect = document.getElementById('sucursal');

            telaSelect.addEventListener('change', function() {
                const selectedOption = telaSelect.options[telaSelect.selectedIndex];
                const precio = selectedOption.getAttribute('data-precio');
                precioInput.value = precio ? precio : '0';                
            });

            agregarButton.addEventListener('click', function() {
                const selectedOption = telaSelect.options[telaSelect.selectedIndex];
                const idTela = selectedOption.getAttribute('data-id');
                const nombreTela = selectedOption.getAttribute('data-nombre');
                const precioVenta = precioVentaInput.value;
                const cantidad = cantidadInput.value;
                if (nombreTela && precioVenta && cantidad) {
                    if (existeTela(idTela)) {
                        alert('La tela ya ha sido agregada.');
                        return;
                    }
                    const nuevaFila = document.createElement('tr');

                    nuevaFila.innerHTML = `                    
                    <td hidden>${idTela}</td>
                    <td>${nombreTela}</td>
                    <td>${precioVenta}</td>
                    <td>${cantidad}</td>
                    <td>
                        <button type="button" class="btn btn-danger btn-sm borrar-fila">Eliminar</button>
                    </td>
                    `;

                    tablaTelas.appendChild(nuevaFila);

                    nuevaFila.querySelector('.borrar-fila').addEventListener('click', function() {
                        nuevaFila.remove();
                        actualizarCampoTelas();
                    });

                    telaSelect.value = '';
                    precioInput.value = '';
                    precioVentaInput.value = '';
                    cantidadInput.value = '';

                    actualizarCampoTelas();
                } else {
                    alert('Por favor complete todos los campos.');
                }
            });

            telaSelect.dispatchEvent(new Event('change'));

            form.addEventListener('submit', function() {
                actualizarCampoTelas();
            });

            function existeTela(idTela) {
                const filas = tablaTelas.querySelectorAll('tr');
                for (const fila of filas) {
                    const celdas = fila.querySelectorAll('td');
                    const idTelaExistente = celdas[0].textContent;
                    if (idTelaExistente == idTela) {
                        return true;
                    }
                }
                return false;
            }

            function actualizarCampoTelas() {
                const filas = tablaTelas.querySelectorAll('tr');
                const telas = [];
                totalInput.value = 0;
                filas.forEach((fila) => {
                    const celdas = fila.querySelectorAll('td');
                    const idTela = celdas[0].textContent;
                    const nombreTela = celdas[1].textContent;
                    const precioVenta = celdas[2].textContent;
                    const cantidad = celdas[3].textContent;
                    totalInput.value = parseFloat(totalInput.value) + parseFloat(precioVenta) * parseFloat(
                        cantidad);

                    telas.push({
                        idTela,
                        nombreTela,
                        precioVenta,
                        cantidad
                    });
                });

                telasInput.value = JSON.stringify(telas);
            }

            /*INPUT FECHA*/
            const today = new Date();
            const yyyy = today.getFullYear();
            const mm = String(today.getMonth() + 1).padStart(2, '0'); // Enero es 0!
            const dd = String(today.getDate()).padStart(2, '0');

            // Formatea la fecha en el formato YYYY-MM-DD
            const formattedToday = `${yyyy}-${mm}-${dd}`;

            // Establece la fecha actual como valor por defecto
            const fechaInput = document.getElementById('fecha');
            if (!fechaInput.value) {
                fechaInput.value = formattedToday;
            }

            //Cambio En La Selección De Sucursal
            function toggleTelaSelect() {
                if (sucursalSelect.value == '0') {
                    telaSelect.disabled = true;
                } else {
                    telaSelect.disabled = false;
                }
                totalInput.value = 0;
                telaSelect.value = '0';
            }

            // Initial check when the page loads
            toggleTelaSelect();

            // Add event listener to the sucursal select
            sucursalSelect.addEventListener('change', toggleTelaSelect);
        });
    </script>
@endsection
