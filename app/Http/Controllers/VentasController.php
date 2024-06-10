<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Sucursales;
use App\Models\Ventas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class VentasController extends Controller
{
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
        $venta->idusuario = Auth::user()->id;
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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
