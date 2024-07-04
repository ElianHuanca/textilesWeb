<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Demanda De Telas </title>
</head>

<body>
    <div class="page-body">
        <div class="container-xl">
            <div class="row row-deck row-cards">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Demanda De Telas Del {{ date('d/m/Y', strtotime($request->fechaini)) }} Al {{ date('d/m/Y', strtotime($request->fechafin)) }}</h3>
                        </div>
                        <div class="table-responsive">
                            <table class="table card-table table-vcenter text-nowrap datatable">
                                <thead>
                                    <tr>
                                        <th class="w-1">Nombre De Telas                                            
                                        </th>
                                        @foreach ($sucursales as $sucursal)
                                            <th>{{ $sucursal->direccion }}</th>
                                        @endforeach
                                    </tr>
                                </thead>
                                <tbody id='tabla-telas'>                                    
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {            
            const tablaTelas = document.getElementById('tabla-telas');
            var telas = @json($telas);
            var sucursales = @json($sucursales);

            function cargarFilas() {            
                // Itera sobre las telas usando un bucle for con índice
                for (var i = 0; i < telas.length; i++) {
                    var fila = document.createElement('tr');
                    var columna = document.createElement('td');
                    columna.textContent = telas[i].tela;
                    fila.appendChild(columna);

                    // Itera sobre las demandas usando un bucle for con índice
                    for (var j = 0; j < sucursales.length; j++) {
                        columna = document.createElement('td');
                        columna.textContent = telas[i].demanda;
                        fila.appendChild(columna);
                        i = i + 1;
                    }

                    tablaTelas.appendChild(fila);
                }
            }
            cargarFilas();
        });
    </script>
</body>

</html>
