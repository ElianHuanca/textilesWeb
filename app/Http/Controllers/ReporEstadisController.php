<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReporEstadisController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function Ganancias_Sucursal()
    {
        $data = DB::table('ventas as v')
            ->join('sucursales as s', 'v.idsucursal', '=', 's.id')
            ->join('det_ventas as dv', 'v.id', '=', 'dv.idventa')
            ->select('s.direccion as sucursal', DB::raw('SUM(dv.ganancias) as total_ganancias'))
            ->groupBy('s.direccion')
            ->get();

        $formattedData = [];
        foreach ($data as $row) {
            $formattedData[] = [
                'name' => $row->sucursal,
                'y' => (float)$row->total_ganancias
            ];
        }

        $jsonData = json_encode($formattedData);

        return view('reportes.ganancias', compact('jsonData'));
    }
    public function Ganancias_Sucursal_Telas()
    {
        $data = DB::table('ventas as v')
            ->join('sucursales as s', 'v.idsucursal', '=', 's.id')
            ->join('det_ventas as dv', 'v.id', '=', 'dv.idventa')
            ->join('telas as t', 'dv.idtela', '=', 't.id')
            ->select('s.direccion as sucursal', 't.nombre as tela', DB::raw('SUM(dv.ganancias) as total_ganancias'))
            ->groupBy('s.direccion', 't.nombre')
            ->get();

        $formattedData = [];
        foreach ($data as $row) {
            $formattedData[] = [
                'name' => $row->sucursal . ' - ' . $row->tela,
                'y' => (float)$row->total_ganancias
            ];
        }

        $jsonData = json_encode($formattedData);

        return view('reportes.ganancias_tela_sucursal', compact('jsonData'));
    }
    public function Ganancias_Telas(){
        $data = DB::table('det_ventas as dv')
            ->join('telas as t', 'dv.idtela', '=', 't.id')
            ->select('t.nombre as tela', DB::raw('SUM(dv.ganancias) as total_ganancias'))
            ->groupBy('t.nombre')
            ->get();

        $formattedData = [];
        foreach ($data as $row) {
            $formattedData[] = [
                'name' => $row->tela,
                'y' => (float)$row->total_ganancias
            ];
        }

        $jsonData = json_encode($formattedData);

        return view('reportes.ganancias_tela', compact('jsonData'));
    }
    public function Ganancias_Telas_2()
    {
        $data = DB::table('ventas as v')
            ->join('det_ventas as dv', 'v.id', '=', 'dv.idventa')
            ->join('telas as t', 'dv.idtela', '=', 't.id')
            ->select('t.nombre as tela', DB::raw('SUM(dv.ganancias) as total_ganancias'))
            ->groupBy('t.nombre')
            ->get();

        $formattedData = [];
        foreach ($data as $row) {
            $formattedData[] = [
                'name' => $row->tela,
                'y' => (float)$row->total_ganancias
            ];
        }

        $jsonData = json_encode($formattedData);

        return view('reportes.ganancias_tela_2', compact('jsonData'));
    }
}
