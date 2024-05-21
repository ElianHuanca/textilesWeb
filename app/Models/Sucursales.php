<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sucursales extends Model
{
    use HasFactory;    

    protected $fillable = ['direccion','zona','celular', 'estado'];

    public $timestamps = false;
    
    public function ventas()
    {
        return $this->hasMany(Ventas::class, 'idsucursal');
    }

    public function sucursalestelas()
    {
        return $this->hasMany(SucursalesTelas::class, 'idsucursal');
    }
}
