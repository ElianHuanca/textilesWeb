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
        $almacenes = Almacenes::all();
        return view('almacenes.index', compact('almacenes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
        $almacen = Almacenes::find($id);
        $almacen->estado = false;
        $almacen->save();
        return redirect()->route('almacenes.index')->with('success', 'Sucursal eliminada exitosamente.');;
    }
}
