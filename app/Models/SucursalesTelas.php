<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SucursalesTelas extends Model
{
    use HasFactory;
    protected $fillable = ['idsucursal', 'idtela', 'stock'];

    public function tela()
    {
        return $this->belongsTo(Telas::class, 'idtela');
    }

    public function sucursal()
    {
        return $this->belongsTo(Sucursales::class, 'idsucursal');
    }
}
