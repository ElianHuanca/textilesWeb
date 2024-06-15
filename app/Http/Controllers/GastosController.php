<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Compras;
use App\Models\TipoGastos;
use Illuminate\Http\Request;

class GastosController extends Controller
{
    //

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
