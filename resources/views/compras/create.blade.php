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
                        Registrar Compra
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
                            <form method="POST" action="{{ route('compras.store') }}">
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
                                        <label for="total" class="form-label">total</label>
                                        <input id="total" type="text" class="form-control" name="total"
                                            value="0">
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="proveedor" class="form-label">proveedor</label>
                                    <select id="proveedor" class="form-control @error('proveedor') is-invalid @enderror"
                                        name="idproveedor" required>
                                        <option value="0">Seleccione un proveedor</option>
                                        @foreach ($proveedores as $proveedor)
                                            <option value="{{ $proveedor->id }}"
                                                {{ old('proveedor') == $proveedor->id ? 'selected' : '' }}>
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
                                <br>
                                <h2 style="text-align: center; padding-top: 20px">Detalles de la compra</h2>
                                <div class="mb-3">
                                    <label for="tela" class="form-label">Tela</label>
                                    <select id="tela" class="form-control @error('tela') is-invalid @enderror"
                                        name="idtela">
                                        <option value="0">Seleccione una tela</option>
                                    </select>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="precio" class="form-label">precio Compra</label>
                                        <div class="input-group">
                                            <input id="precio" type="text"
                                                class="form-control @error('precio') is-invalid @enderror" name="precio"
                                                value="" autofocus>
                                            <div class="input-group-append">
                                                <span class="input-group-text">Bs</span>
                                            </div>
                                        </div>
                                        @error('precio')
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
                                <button type="button" class="btn btn-primary" id="agregar-tela">Agregar</button>
                                <br>
                                <input type="hidden" id="telas" name="telas">
                                <table class="table mt-3">
                                    <thead>
                                        <tr>
                                            <th>Nombre Tela</th>
                                            <th>Precio Venta</th>
                                            <th>Cantidad</th>
                                            <th>Importe</th>
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

            // Atributos
            const telaSelect = document.getElementById('tela');
            const totalInput = document.getElementById('total');
            const tablaTelas = document.getElementById('tabla-telas');
            const proveedorSelect = document.getElementById('proveedor');
            const agregarButton = document.getElementById('agregar-tela');
            const telasInput = document.getElementById('telas');
            const precioInput = document.getElementById('precio');
            const cantidadInput = document.getElementById('cantidad');

            //metodos
            function agregarTela() {
                const idtela = telaSelect.value;
                const tela = telaSelect.options[telaSelect.selectedIndex].textContent;
                const precio = precioInput.value;
                const cantidad = cantidadInput.value;
                const importe = precio * cantidad;
                if (validarDatos(idtela, precio, cantidad)) {
                    return;
                }

                const nuevaFila = document.createElement('tr');

                nuevaFila.innerHTML = `
                    <td hidden>${idtela}</td>
                    <td>${tela}</td>
                    <td>${precio}</td>
                    <td>${cantidad}</td>
                    <td>${importe}</td>
                    <td>
                        <button type="button" class="btn btn-danger btn-sm borrar-fila">Eliminar</button>
                    </td>
                `;

                tablaTelas.appendChild(nuevaFila);

                let telasArray = JSON.parse(telasInput.value || '[]');
                telasArray.push({
                    idtela: parseInt(idtela),
                    precio: parseFloat(precio),
                    cantidad: parseFloat(cantidad),
                    total: parseFloat(importe)
                });
                telasInput.value = JSON.stringify(telasArray);
                nuevaFila.querySelector('.borrar-fila').addEventListener('click', function() {
                    totalInput.value = parseFloat(totalInput.value) - parseFloat(importe);
                    telasArray = telasArray.filter(tela => !(tela.idtela === idtela));
                    telasInput.value = JSON.stringify(telasArray);
                    nuevaFila.remove();
                    //tablaTelas.removeChild(nuevaFila);                    
                });

                totalInput.value = parseFloat(totalInput.value) + parseFloat(importe);
                telaSelect.value = '0';
                precioInput.value = '';
                cantidadInput.value = '';
            }

            function validarDatos(idtela, precio, cantidad) {
                if (idtela == 0) {
                    alert('Seleccione una tela');
                    return true;
                }
                if (precio == '') {
                    alert('Ingrese el precio de la tela');
                    return true;
                }
                if (cantidad == '') {
                    alert('Ingrese la cantidad de tela');
                    return true;
                }
                if (isNaN(parseFloat(precio)) || isNaN(parseFloat(cantidad))) {
                    alert('Por favor ingrese un número válido.');
                    return false;
                }
                if (parseFloat(cantidad) <= 0) {
                    alert('La cantidad de tela debe ser mayor a 0');
                    return true;
                }
                if (parseFloat(precio) <= 0) {
                    alert('El precio de la tela debe ser mayor a 0');
                    return true;
                }
                if (existeTela(idtela)) {
                    alert('La tela ya fue agregada');
                    return true;
                }
                return false;
            }

            function existeTela(idtela) {
                const filas = tablaTelas.querySelectorAll('tr');
                for (const fila of filas) {
                    const celdas = fila.querySelectorAll('td');
                    const idTelaExistente = celdas[0].textContent;
                    if (idTelaExistente == idtela) {
                        return true;
                    }
                }
                return false;
            }

            agregarButton.addEventListener('click', agregarTela);

            function changeProveedor() {
                const idproveedor = proveedorSelect.value;
                const telasPorProveedor = {!! $telasPorProveedorJson !!};

                if (idproveedor == 0) {
                    telaSelect.disabled = true;
                } else {
                    telaSelect.disabled = false;
                    telaSelect.innerHTML = '<option value="0">Seleccione una tela</option>';

                    if (idproveedor && telasPorProveedor[idproveedor]) {
                        telasPorProveedor[idproveedor].forEach(tela => {
                            const option = document.createElement('option');
                            option.value = tela.id;
                            option.textContent = tela.nombre;
                            telaSelect.appendChild(option);
                        });
                    }
                }
                totalInput.value = '0';
                telaSelect.value = '0';
                borrarTodasLasFilas();
            }

            // Función para borrar todas las filas de la tabla
            function borrarTodasLasFilas() {
                // Selecciona todas las filas de la tabla
                const filas = tablaTelas.querySelectorAll('tr');

                // Recorre todas las filas y las elimina
                filas.forEach(fila => fila.remove());
            }

            changeProveedor();

            proveedorSelect.addEventListener('change', changeProveedor);
        });
    </script>
@endsection
