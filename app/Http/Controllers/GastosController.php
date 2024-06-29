<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\AdicionGastos;
use App\Models\Compras;
use App\Models\DetCompras;
use App\Models\TipoGastos;
use Illuminate\Http\Request;

class GastosController extends Controller
{
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
        $detcompras= DetCompras::where('idcompra', $idcompra)->get();
        $tipogastos = TipoGastos::where('estado', true)->get();
        return view('gastos.create', compact('compra','detcompras', 'tipogastos'));
    }

    public function store(Request $request){          
        $gastos = is_string($request->gastos) ? json_decode($request->gastos, true) : $request->gastos;
        foreach ($gastos as $gasto){
            $ag = new AdicionGastos();
            $ag->idcompra = $request->idcompra;
            $ag->idgasto = $gasto['idgasto'];
            $ag->costo = $gasto['costo'];
            $ag->save();            
        }        
        $telas = is_string($request->telas) ? json_decode($request->telas, true) : $request->telas;
        foreach ($telas as $tela){
            DetCompras::where('idcompra', $request->idcompra)
                ->where('idtela', $tela['idtela'])
                ->increment('totalag', $tela['totalag']);            
        }
        $compra = Compras::find($request->idcompra);
        $compra->totalag = $request->totalag;
        $compra->save();
        return redirect()->route('compras.index');
    }
}
