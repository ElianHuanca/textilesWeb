<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetCompras extends Model
{
    use HasFactory;

    protected $fillable = ['idcompra', 'idtela', 'cantidad', 'precio', 'totalag','total'];

    // Indicar que no hay una clave primaria incrementada
    public $incrementing = false;

    // Si no hay una columna 'id', indicar que no hay clave primaria
    protected $primaryKey = null;
    
    public $timestamps = false;

    public function compra()
    {
        return $this->belongsTo(Compras::class, 'idcompra');
    }

    public function tela()
    {
        return $this->belongsTo(Telas::class, 'idtela');
    }
}
