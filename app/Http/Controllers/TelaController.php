<?php

namespace App\Http\Controllers;

use App\Models\Tela;
use Illuminate\Http\Request;

class TelaController extends Controller
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
        $telas = Tela::orderBy('id', 'asc')->paginate(5);
        return view('telas.index', compact('telas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('telas.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Tela::create($request->all());
        return redirect()->route('telas.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Tela $tela)
    {
        return view('telas.show', compact('tela'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Tela $tela)
    {
        return view('telas.edit', compact('tela'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Tela $tela)
    {
        $tela->update($request->all());
        return redirect()->route('telas.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tela $tela)
    {
        $tela->delete();
        return redirect()->route('telas.index');
    }
}
