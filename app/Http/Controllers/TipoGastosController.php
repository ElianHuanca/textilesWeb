<?php

namespace App\Http\Controllers;

use App\Models\TipoGastos;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TipoGastosController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tipogastos = TipoGastos::where('estado', true)->orderby('id','asc')->pagination(10);
        return view('tipogastos.index', compact('tipogastos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('tipogastos.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {        
        TipoGastos::create($request->all());

        return redirect()->route('tipogastos.index')
            ->with('success', 'Tipo de gasto creado correctamente.');
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
        $tipogasto = TipoGastos::find($id);
        return view('tipogastos.edit', compact('tipogasto'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $tipogasto = TipoGastos::find($id);
        $tipogasto->update($request->all());

        return redirect()->route('tipogastos.index')
            ->with('success', 'Tipo de gasto actualizado correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $tipogasto = TipoGastos::find($id);
        $tipogasto->estado = false;
        $tipogasto->save();
        return redirect()->route('tipogastos.index')
            ->with('success', 'Tipo de gasto eliminado correctamente.');
    }
}
