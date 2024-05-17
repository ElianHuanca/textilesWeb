<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Proveedores;
use App\Models\Telas;
use Illuminate\Http\Request;

class TelasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $telas = Telas::all()->orderby('id', 'desc')->orderby('estado', 'desc');
        return view('telas.index', compact('telas'));
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
        $tela = new Telas();
        $tela->nombre = $request->nombre;
        $tela->precioxmen = $request->precioxmen;
        $tela->precioxmay = $request->precioxmay;
        $tela->precioxrollo = $request->precioxrollo;
        $tela->precioxcompra = $request->precioxcompra;
        $tela->idproveedor = $request->idproveedor;
        $tela->save();
        return redirect()->route('telas.index')->with('success', 'Tela creada exitosamente.');
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
        $tela->nombre = $request->nombre;
        $tela->precioxmen = $request->precioxmen;
        $tela->precioxmay = $request->precioxmay;
        $tela->precioxrollo = $request->precioxrollo;
        $tela->precioxcompra = $request->precioxcompra;
        $tela->idproveedor = $request->idproveedor;
        $tela->save();
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