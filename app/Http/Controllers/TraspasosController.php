<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Almacenes;
use App\Models\AlmacenesTelas;
use App\Models\Sucursales;
use App\Models\SucursalesTelas;
use App\Models\Telas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TraspasosController extends Controller
{
    public function create(){
        $sucursales = Sucursales::where('estado',true)->get();
        $almacenes = Almacenes::where('estado',true)->get();
        $telas = Telas::where('estado',true)->get();

        $telasSucursales = SucursalesTelas::all();
        $telasAlmacenes = AlmacenesTelas::all();
        return view('traspasos.create', compact('sucursales','almacenes','telas','telasSucursales','telasAlmacenes'));
    }
    public function store(Request $request){
        $telas = is_string($request->telas) ? json_decode($request->telas, true) : $request->telas;
        foreach ($telas as $tela) {
            SucursalesTelas::where('idsucursal', $request->idsucursal)
                ->where('idtela', $tela['idtela'])
                ->increment('stock', $tela['cantidad']);
            AlmacenesTelas::where('idalmacen', $request->idalmacen)
                ->where('idtela', $tela['idtela'])
                ->decrement('stock', $tela['cantidad']);
        }
        return redirect()->route('traspasos.create')->with('success', 'Traspaso realizado con éxito.');
    }
}
