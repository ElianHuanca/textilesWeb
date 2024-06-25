<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Almacenes;
use App\Models\AlmacenesTelas;
use App\Models\Compras;
use App\Models\DetCompras;
use App\Models\DetVentas;
use App\Models\Recepciones;
use App\Models\SucursalesTelas;
use App\Models\Telas;
use App\Models\Ventas;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RecepcionesController extends Controller
{
    public function index()
    {
        $comprasnr = Compras::leftJoin('recepciones', 'compras.id', '=', 'recepciones.idcompra')
            ->whereNull('recepciones.idcompra')
            ->select('compras.*')
            ->get();
        return view('recepciones.index', compact('comprasnr'));
    }

    public function create($idcompra)
    {
        $compra = Compras::find($idcompra);
        $detcompras = DetCompras::where('idcompra', $idcompra)->get();
        $almacenes = Almacenes::where('estado', true)->get();
        return view('recepciones.create', compact('compra', 'detcompras', 'almacenes'));
    }

    public function store(Request $request)
    {
        $compra = Compras::find($request->idcompra);
        $recepcion = new Recepciones();
        $recepcion->idcompra = $request->idcompra;
        $recepcion->idalmacen = $request->idalmacen;
        $recepcion->fecha = $request->fecha;
        $recepcion->idusuario = Auth::user()->id;
        $fechaCompra = new DateTime($compra->fecha);
        $fechaRecepcion = new DateTime($request->fecha);
        $intervalo = $fechaCompra->diff($fechaRecepcion);
        $recepcion->tiempo = $intervalo->days;
        $recepcion->save();

        $detcompras = DetCompras::where('idcompra', $request->idcompra)->get();
        foreach ($detcompras as $detcompra) {
            $this->actualizarCostoPromedioPonderado($detcompra);
            AlmacenesTelas::where('idtela', $detcompra->idtela)
                ->where('idalmacen', $request->idalmacen)
                ->increment('stock', $detcompra->cantidad);
            $this->actualizarROP($detcompra);
        }

        return redirect()->route('recepciones.index');
    }

    public function actualizarROP(DetCompras $detcompra){
        $tiempoEntregaPromedio = Recepciones::selectRaw('AVG(tiempo) as tiempoPromedio')->where('idcompra',$detcompra->idcompra)->first()->tiempoPromedio;
        $venta = Ventas::whereHas('detVentas', function($query) use ($detcompra) {
            $query->where('idtela', $detcompra->idtela);
        })->latest('fecha')->first();
        if ($venta === null) {            
            return;
        }
        $fechaUltimaVenta = new DateTime($venta->fecha);
        $fechaPrimeraVenta = new DateTime(Ventas::whereHas('detVentas', function($query) use ($detcompra) {
            $query->where('idtela', $detcompra->idtela);
        })->oldest('fecha')->first()->fecha);        
        $intervalo = $fechaUltimaVenta->diff($fechaPrimeraVenta);
        $periodo = $intervalo->days; 
        if ($periodo == 0) {
            $periodo = 1;
        }else{
            $periodo = $periodo * 0.857143; // aqui se le corta al periodo porque no se atiende los domingos
        }

        $historialDeDemanda = DetVentas::where('idtela', $detcompra->idtela)->sum('cantidad');

        $demandaPromedio = $historialDeDemanda / $periodo;

        $tela = Telas::find($detcompra->idtela);
        $rop = $demandaPromedio * $tiempoEntregaPromedio + $tela->seguridad;
        $tela->rop = $rop;
        $tela->seguridad = $rop * 0.2;
        $tela->save();
    }

    public function actualizarCostoPromedioPonderado(DetCompras $detcompra){
        $tela = Telas::find($detcompra->idtela);
        // Obtener la sumatoria del stock en almacenes y sucursales para la tela específica
        $stockAlmacenes = AlmacenesTelas::where('idtela', $detcompra->idtela)->sum('stock');
        $stockSucursales = SucursalesTelas::where('idtela', $detcompra->idtela)->sum('stock');
        
        // Sumar el stock de almacenes y sucursales
        $stockInventario = $stockAlmacenes + $stockSucursales;
        
        // Calcular el costo del inventario actual
        $costoInventario = $stockInventario * $tela->precioxcompra;

         // Calcular el costo total de la compra actual, incluyendo el total y cualquier gasto adicional
        $costoCompra = $detcompra->total + $detcompra->totalag;
        
        // Calcular el costo total combinando el costo del inventario actual y el costo de la compra
        $costoTotal = $costoInventario + $costoCompra;

        // Calcular el nuevo stock total combinando el stock del inventario actual y la cantidad de la compra
        $stockTotal = $stockInventario + $detcompra->cantidad;

        // Calcular el costo unitario promedio ponderado
        $costoUnitarioPromedioPonderado = $costoTotal / $stockTotal;

        // Actualizar el costo unitario promedio ponderado en la base de datos
        $tela->precioxcompra = $costoUnitarioPromedioPonderado;
        $tela->save();
    }
}
