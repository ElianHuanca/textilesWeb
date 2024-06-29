<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Sucursales;
use App\Models\Telas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReportesController extends Controller
{
    public function formdemandas()
    {
        $sucursales = Sucursales::where('estado', true)->get();
        return view('reportes.formdemandas', compact('sucursales'));
    }

    public function demandas(Request $request)
    {
        $sucursales = Sucursales::where('estado', true)->get();
        $query = "
        SELECT dv.idtela,t.nombre as tela,v.idsucursal,s.direccion as sucursal, SUM(dv.cantidad) as demanda
        FROM sucursales s
        JOIN ventas v ON v.idsucursal = s.id AND v.fecha BETWEEN ? AND ?
        JOIN det_ventas dv ON dv.idventa = v.id
        JOIN telas t ON t.id = dv.idtela
        group by dv.idtela, v.idsucursal, s.direccion, t.nombre
        order by dv.idtela, v.idsucursal        
        ";
        
        $telas = DB::select($query, [$request->fechaini, $request->fechafin]);
        dd($telas);
        return view('reportes.demandas', compact('sucursales'));
    }
}
