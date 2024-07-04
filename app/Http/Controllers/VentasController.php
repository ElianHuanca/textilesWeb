<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\DetVentas;
use App\Models\Sucursales;
use App\Models\SucursalesTelas;
use App\Models\Ventas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class VentasController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('can:ventas.index')->only(['index', 'show']);
        $this->middleware('can:ventas.create')->only(['create', 'store']);
        $this->middleware('can:ventas.edit')->only(['edit', 'update']);
        $this->middleware('can:ventas.destroy')->only('destroy');
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $ventas = Ventas::where('estado', true)->paginate(10);
        return view('ventas.index', compact('ventas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $telas = DB::table('sucursalestelas as st')
            ->join('sucursales as s', function ($join) {
                $join->on('s.id', '=', 'st.idsucursal')
                    ->where('s.estado', true);
            })
            ->join('telas as t', function ($join) {
                $join->on('t.id', '=', 'st.idtela')
                    ->where('t.estado', true);
            })
            ->where('st.stock', '>', 0)
            ->select('st.*', 't.*')
            ->orderBy('t.nombre')
            ->get();

        $telasPorSucursal = [];
        foreach ($telas as $tela) {
            $telasPorSucursal[$tela->idsucursal][] = $tela;
        }

        // Convertir a JSON para usar en JavaScript
        $telasPorSucursalJson = json_encode($telasPorSucursal);

        $sucursales = Sucursales::where('estado', true)->get();
        return view('ventas.create', compact('sucursales', 'telasPorSucursalJson'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $venta = new Ventas();
        $venta->fecha = $request->fecha;
        $venta->total = $request->total;
        $venta->ganancias = $request->ganancias;
        $venta->descuento = $request->descuento ?: 0;
        $venta->idsucursal = $request->idsucursal;
        $venta->idusuario = Auth::user()->id;
        $venta->save();

        $telas = is_string($request->telas) ? json_decode($request->telas, true) : $request->telas;

        foreach ($telas as $tela) {
            $detventa = new DetVentas();
            $detventa->idventa = $venta->id;
            $detventa->idtela = $tela['idTela'];
            $detventa->precio = $tela['precioVenta'];
            $detventa->cantidad = $tela['cantidad'];
            $detventa->total = $tela['importe'];
            $detventa->ganancias = $tela['ganancias'];
            $detventa->save();

            // Actualizar stock
            SucursalesTelas::where('idsucursal', $venta->idsucursal)
                ->where('idtela', $tela['idTela'])
                ->decrement('stock', $tela['cantidad']);

            //Si tu venta es menor o igual al rop, que notifique al gerente
        }
        return redirect()->route('ventas.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $venta = Ventas::findOrFail($id);
        $detventas = DetVentas::where('idventa', $id)->get();
        return view('ventas.show', compact('venta', 'detventas'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
