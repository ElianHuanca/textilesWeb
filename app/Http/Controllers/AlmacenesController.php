<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Almacenes;
use App\Models\Telas;
use Illuminate\Http\Request;

class AlmacenesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $almacenes = Almacenes::all()->orderby('id', 'desc')->orderby('estado', 'desc');
        return view('almacenes.index', compact('almacenes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {        
        return view('almacenes.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $almacen = new Almacenes();
        $almacen->direccion = $request->direccion;
        $almacen->zona = $request->zona;
        $almacen->celular = $request->celular;        
        $almacen->save();
        return redirect()->route('almacenes.index')->with('success', 'Almacen creada exitosamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $almacen = Almacenes::with('almacenesTelas.tela')->find($id);        
        return view('almacenes.show', compact('almacen'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $almacen = Almacenes::find($id);
        return view('almacenes.edit', compact('almacen'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $almacen = Almacenes::find($id);
        $almacen->direccion = $request->direccion;
        $almacen->zona = $request->zona;
        $almacen->celular = $request->celular;        
        $almacen->save();
        return redirect()->route('almacenes.index')->with('success', 'Almacen actualizada exitosamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $almacen = Almacenes::find($id);
        $almacen->estado = false;
        $almacen->save();
        return redirect()->route('almacenes.index')->with('success', 'Almacen eliminada exitosamente.');;
    }
}
