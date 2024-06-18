<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Recepciones extends Model
{
    use HasFactory;

    protected $fillable = ['fecha', 'tiempo', 'idcompra', 'idalmacen','idusuario', 'estado'];

    public $timestamps = false;
    
    public function compra()
    {
        return $this->belongsTo(Compras::class, 'idcompra');
    }

    public function almacen()
    {
        return $this->belongsTo(Almacenes::class, 'idalmacen');
    }

    public function usuario()
    {
        return $this->belongsTo(User::class, 'idusuario');
    }
}
