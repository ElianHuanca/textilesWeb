<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Telas extends Model
{
    use HasFactory;

    protected $fillable = ['nombre', 'precioxmen','precioxmay','precioxrollo','precioxcompra','rop','seguridad', 'idproveedor', 'estado'];

    public $timestamps = false;
    
    public function proveedor()
    {
        return $this->belongsTo(Proveedores::class, 'idproveedor');
    }

    public function sucursalesTelas()
    {
        return $this->hasMany(SucursalesTelas::class, 'idtela');
    }

    public function almacenesTelas()
    {
        return $this->hasMany(AlmacenesTelas::class, 'idtela');
    }
}
