<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Proveedores;
use App\Models\Telas;
use Illuminate\Http\Request;

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
        $telas = Telas::where('estado',true)->orderby('id', 'asc')->paginate(10);
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
        Telas::create($request->all());
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
