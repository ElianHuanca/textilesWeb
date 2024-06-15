<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Compras extends Model
{
    use HasFactory;

    protected $fillable = ['fecha', 'total', 'totalAG', 'idproveedor','estado'];

    public $timestamps = false;

    public function detCompras()
    {
        return $this->hasMany(DetCompras::class, 'idcompra');
    }

    public function proveedor()
    {
        return $this->belongsTo(Proveedores::class, 'idproveedor');
    }

    public function recepcion()
    {
        return $this->hasMany(Recepciones::class, 'idcompra');
    }

    public function gastos(){
        return $this->hasMany(AdicionGastos::class, 'idcompra');
    }
    /* public function almacen()
    {
        return $this->belongsTo(Almacenes::class, 'idalmacen');
    } */
}
