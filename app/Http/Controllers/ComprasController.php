<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Compras;
use App\Models\DetCompras;
use App\Models\Proveedores;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ComprasController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('can:compras.index')->only(['index', 'show']);
        $this->middleware('can:compras.create')->only(['create', 'store']);
        $this->middleware('can:compras.edit')->only(['edit', 'update']);
        $this->middleware('can:compras.destroy')->only('destroy');
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $compras = Compras::where('estado', true)->paginate(10);
        return view('compras.index', compact('compras'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $proveedores = Proveedores::where('estado', true)->get();
        $telas = DB::table('telas as t')
            ->join('proveedores as p', function ($join) {
                $join->on('p.id', '=', 't.idproveedor')
                    ->where('p.estado', true);
            })
            ->where('t.estado', true)
            ->select('p.*', 't.*')
            ->orderBy('t.nombre')
            ->get();

        $telasPorProveedor = [];
        foreach ($telas as $tela) {
            $telasPorProveedor[$tela->idproveedor][] = $tela;
        }

        // Convertir a JSON para usar en JavaScript
        $telasPorProveedorJson = json_encode($telasPorProveedor);

        return view('compras.create', compact('proveedores','telasPorProveedorJson'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {        
        $compra = new Compras();
        $compra->fecha = $request->fecha;
        $compra->total = $request->total;
        $compra->idproveedor = $request->idproveedor;
        $compra->save();
        
        $telas = is_string($request->telas) ? json_decode($request->telas, true) : $request->telas;        
        foreach ($telas as $tela) {
            $detCompra = new DetCompras();
            $detCompra->idcompra = $compra->id;
            $detCompra->idtela = $tela['idtela'];
            $detCompra->cantidad = $tela['cantidad'];
            $detCompra->precio = $tela['precio'];
            $detCompra->total = $tela['total'];
            $detCompra->save();            
        }
        return redirect()->route('compras.index');
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
