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
                                <h2 style="text-align: center; padding-top: 20px">Compra</h2>
                                <input type="hidden" name="idcompra" value="{{ $compra->id }}">
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="fecha" class="form-label">fecha</label>
                                        <input id="fecha" type="text" class="form-control" name="fecha"
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
                                            <th>Porcentaje</th>
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
                                                <td>0</td>
                                                <td>0</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <h2 style="text-align: center; padding-top: 20px">Adicionar Gastos</h2>
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="descripcion" class="form-label">Tipo Gasto</label>
                                        <select id="gasto" class="form-control @error('gasto') is-invalid @enderror"
                                            name="idgasto">
                                            <option value="0">Seleccione un gasto</option>
                                            @foreach ($tipogastos as $gasto)
                                                <option value="{{ $gasto->id }}">{{ $gasto->descripcion }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="costo" class="form-label">costo</label>
                                        <input id="costo" type="text" class="form-control" name="costo">
                                    </div>
                                </div>
                                <button type="button" class="btn btn-primary" id="agregar-gasto">Agregar</button>
                                <input type="hidden" id="gastos" name="gastos">
                                <table class="table mt-3">
                                    <thead>
                                        <tr>
                                            <th>Descripcion</th>
                                            <th>Costo</th>
                                            <th>Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody id="tabla-gastos">
                                    </tbody>
                                </table>
                                <!-- Puedes agregar más campos según sea necesario -->
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
            const tablaGastos = document.getElementById('tabla-gastos');
            const costoInput = document.getElementById('costo');
            const gastoSelect = document.getElementById('gasto');
            const agregarButton = document.getElementById('agregar-gasto');
            const totalagInput = document.getElementById('totalag');
            const gastosInput = document.getElementById('gastos');
            const tablaTelas = document.querySelector('.tabla-telas');
            const totalInput = document.getElementById('total');
            const telasInput = document.getElementById('telas');

            function agregarGasto() {
                const idgasto = gastoSelect.value;
                const gasto = gastoSelect.options[gastoSelect.selectedIndex].textContent;
                const costo = costoInput.value;
                if (!validarDatos(idgasto, costo)) {
                    return;
                }

                if (existeGasto(idgasto)) {
                    alert('El gasto ya fue agregado');
                    return;
                }
                const nuevaFila = document.createElement('tr');

                nuevaFila.innerHTML = `
                    <td hidden>${idgasto}</td>
                    <td>${gasto}</td>
                    <td>${costo}</td>                    
                    <td>
                        <button type="button" class="btn btn-danger btn-sm borrar-fila">Eliminar</button>
                    </td>
                `;

                tablaGastos.appendChild(nuevaFila);
                let gastosArray = JSON.parse(gastosInput.value || '[]');
                gastosArray.push({
                    idgasto,
                    costo: parseFloat(costo)
                });
                gastosInput.value = JSON.stringify(gastosArray);

                nuevaFila.querySelector('.borrar-fila').addEventListener('click', () => {
                    totalagInput.value = parseFloat(totalagInput.value) - parseFloat(costo);
                    gastosArray = gastosArray.filter(gasto => gasto.idgasto != idgasto);
                    gastosInput.value = JSON.stringify(gastosArray);
                    nuevaFila.remove();
                    actualizarAG();
                });

                totalagInput.value = parseFloat(totalagInput.value) + parseFloat(costo);
                gastoSelect.value = '0';
                costoInput.value = '';
                actualizarAG();
            }

            function validarDatos(idgasto, costo) {
                if (idgasto == 0) {
                    alert('Seleccione un gasto');
                    return false;
                }
                if (costo == '') {
                    alert('Ingrese el costo');
                    return false;
                }
                if (parseFloat(costo) <= 0) {
                    alert('El costo debe ser mayor a 0');
                    return false;
                }
                return true;
            }

            function existeGasto(idgasto) {
                const gastosArray = JSON.parse(gastosInput.value || '[]');
                return gastosArray.some(gasto => gasto.idgasto == idgasto);
            }

            function telasPorcentaje() {
                const filas = tablaTelas.querySelectorAll('tr');
                const total = parseFloat(totalInput.value);
                for (const fila of filas) {
                    const celdas = fila.querySelectorAll('td');
                    const importe = celdas[4].textContent;
                    const porcentaje = importe / total;    
                    celdas[5].textContent = porcentaje.toFixed(2);                                    
                }
            }

            function actualizarAG(){
                const telasArray = [];                
                const filas = tablaTelas.querySelectorAll('tr');
                const totalag = parseFloat(totalagInput.value);
                for(const fila of filas){                    
                    const celdas = fila.querySelectorAll('td');
                    const porcentaje = celdas[5].textContent;
                    const importe = totalag * porcentaje;
                    celdas[6].textContent = importe.toFixed(2);
                    telasArray.push({
                        idtela: celdas[0].textContent,
                        totalag:importe
                    });                
                }
                telasInput.value = JSON.stringify(telasArray);
            }
            telasPorcentaje();
            agregarButton.addEventListener('click', agregarGasto);
        });
    </script>
@endsection
