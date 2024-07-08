<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Almacenes;
use App\Models\AlmacenesTelas;
use App\Models\Proveedores;
use App\Models\Sucursal;
use App\Models\SucursalesTelas;
use App\Models\Telas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class TelasController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('can:telas.index')->only(['index', 'show']);
        $this->middleware('can:telas.create')->only(['create', 'store']);
        $this->middleware('can:telas.edit')->only(['edit', 'update']);
        $this->middleware('can:telas.destroy')->only('destroy');
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $telas = Telas::where('estado',true)->where('rop','>',0)->orderby('id', 'asc')->get();

        $telasFiltradas = $telas->filter(function ($tela) {
            $stockAlmacenes = AlmacenesTelas::where('idtela', $tela->id)->sum('stock');
            $stockSucursales = SucursalesTelas::where('idtela', $tela->id)->sum('stock');
            $stockTotal = $stockAlmacenes + $stockSucursales;
            $tela->stock = $stockTotal;
            return $tela->rop >= $stockTotal;
        });        
        // Si necesitas una colección en lugar de un array
        $telas2 = $telasFiltradas->values();
        $telas = Telas::where('estado',true)->orderby('id', 'asc')->paginate(10);        
        return view('telas.index', compact('telas','telas2'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $proveedores = Proveedores::where('estado', true)->get();
        return view('telas.create', compact('proveedores'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Telas::create($request->all());
        return redirect()->route('telas.index')->with('success', 'Tela creada exitosamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        session()->forget('data');
        $tela = Telas::find($id);
        $stockAlmacenes = AlmacenesTelas::where('idtela', $id)->sum('stock');
        $stockSucursales = SucursalesTelas::where('idtela', $id)->sum('stock');
        $tela->stock = $stockAlmacenes + $stockSucursales;
        $alm = AlmacenesTelas::where('idtela', $id)->get();
        $suc = SucursalesTelas::where('idtela', $id)->get();        
        $url = 'http://localhost:8080/api/notificaciones/';
        //$url = 'https://notificaciones-serve.onrender.com/api/notificaciones/';
        Http::delete($url . $id);
        return view('telas.show', compact('tela', 'alm', 'suc'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $tela = Telas::find($id);
        $proveedores = Proveedores::where('estado', true)->get();
        return view('telas.edit', compact('tela', 'proveedores'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $tela = Telas::find($id);
        $tela->update($request->all());
        return redirect()->route('telas.index')->with('success', 'Tela actualizada exitosamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $tela = Telas::find($id);
        $tela->estado = false;
        $tela->save();
        return redirect()->route('telas.index')->with('success', 'Tela eliminada exitosamente.');
    }
}
