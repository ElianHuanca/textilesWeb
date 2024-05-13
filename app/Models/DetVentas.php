<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetVentas extends Model
{
    use HasFactory;

    protected $fillable = ['idventa', 'idtela', 'precio', 'cantidad', 'total', 'ganancias', 'estado'];

    public function venta()
    {
        return $this->belongsTo(Ventas::class, 'idventa');
    }

    public function tela()
    {
        return $this->belongsTo(Telas::class, 'idtela');
    }
}
