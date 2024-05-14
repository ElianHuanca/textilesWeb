<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetCompras extends Model
{
    use HasFactory;

    protected $fillable = ['idcompra', 'idtela', 'cantidad', 'precio', 'precioAG'];

    public function compra()
    {
        return $this->belongsTo(Compras::class, 'idcompra');
    }

    public function tela()
    {
        return $this->belongsTo(Telas::class, 'idtela');
    }
}
