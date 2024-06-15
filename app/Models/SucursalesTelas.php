<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SucursalesTelas extends Model
{
    use HasFactory;
    
    protected $table = 'sucursalestelas';

    protected $fillable = ['idsucursal', 'idtela', 'stock'];

    // Indicar que no hay una clave primaria incrementada
    public $incrementing = false;

    // Si no hay una columna 'id', indicar que no hay clave primaria
    protected $primaryKey = null;
    
    public $timestamps = false;

    public function tela()
    {
        return $this->belongsTo(Telas::class, 'idtela');
    }

    public function sucursal()
    {
        return $this->belongsTo(Sucursales::class, 'idsucursal');
    }
}
