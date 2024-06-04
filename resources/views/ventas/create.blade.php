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
                                        {{-- <input id="descuento" type="text" class="form-control @error('descuento') is-invalid @enderror" name="descuento" value="{{ old('descuento') }}" required autofocus> --}}
                                        <div class="input-group">
                                            <input id="descuento" type="text"
                                                class="form-control @error('descuento') is-invalid @enderror"
                                                name="descuento" value="{{ old('descuento') }}" required autofocus>
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
                                <div class="mb-3">
                                    <label for="sucursal" class="form-label">sucursales</label>
                                    <select id="sucursal" class="form-control @error('sucursal') is-invalid @enderror"
                                        name="idsucursal" required>
                                        <option value="">Seleccione una sucursal</option>
                                        @foreach ($sucursales as $sucursal)
                                            <option value="{{ $sucursal->id }}"
                                                {{ old('sucursal') == $sucursal->id ? 'selected' : '' }}>
                                                {{ $sucursal->direccion }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <br>
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="tela" class="form-label">Tela</label>
                                        <select id="tela" class="form-control @error('tela') is-invalid @enderror"
                                            name="idtela" required>
                                            <option value="">Seleccione una tela</option>
                                            @foreach ($telas as $tela)
                                                <option value="{{ $tela->id }}" data-precio="{{ $tela->precioxcompra }}"
                                                    data-nombre="{{ $tela->nombre }}"
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
                                            value="{{ old('precio') }}" required autofocus>
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
                                            value="{{ old('cantidad') }}" required autofocus>
                                        @error('cantidad')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <button type="button" class="btn btn-primary" id="agregar-tela">Agregar</button>
                                <br>
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

            telaSelect.addEventListener('change', function() {
                const selectedOption = telaSelect.options[telaSelect.selectedIndex];
                const precio = selectedOption.getAttribute('data-precio');
                precioInput.value = precio ? precio : '0';
            });

            // Trigger change event on load to populate initial value if a tela is already selected
            telaSelect.dispatchEvent(new Event('change'));
        });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const telaSelect = document.getElementById('tela');
            const precioInput = document.getElementById('precioxcompra');
            const precioVentaInput = document.getElementById('precio');
            const cantidadInput = document.getElementById('cantidad');
            const agregarButton = document.getElementById('agregar-tela');
            const tablaTelas = document.getElementById('tabla-telas');

            telaSelect.addEventListener('change', function() {
                const selectedOption = telaSelect.options[telaSelect.selectedIndex];
                const precio = selectedOption.getAttribute('data-precio');
                precioInput.value = precio ? precio : '';
            });

            agregarButton.addEventListener('click', function() {
                const selectedOption = telaSelect.options[telaSelect.selectedIndex];
                const nombreTela = selectedOption.getAttribute('data-nombre');
                const precioVenta = precioVentaInput.value;
                const cantidad = cantidadInput.value;

                if (nombreTela && precioVenta && cantidad) {
                    const nuevaFila = document.createElement('tr');

                    nuevaFila.innerHTML = `
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
                    });

                    telaSelect.value = '';
                    precioInput.value = '';
                    precioVentaInput.value = '';
                    cantidadInput.value = '';
                } else {
                    alert('Por favor complete todos los campos.');
                }
            });

            telaSelect.dispatchEvent(new Event('change'));
        });
    </script>
@endsection

{{-- <button type="submit" class="btn btn-primary">Guardar</button> --}}
