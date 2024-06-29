<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Compras;
use App\Models\TipoGastos;
use Illuminate\Http\Request;

class GastosController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('can:gastos.index')->only(['index', 'show']);
        $this->middleware('can:gastos.create')->only(['create', 'store']);
        $this->middleware('can:gastos.edit')->only(['edit', 'update']);
        $this->middleware('can:gastos.destroy')->only('destroy');
    }

    public function index()
    {
        return view('gastos.index');
    }

    public function create($idcompra){
        $compra = Compras::find($idcompra);
        $tipogastos = TipoGastos::where('estado', true)->get();
        return view('gastos.create', compact('compra', 'tipogastos'));
    }
}
