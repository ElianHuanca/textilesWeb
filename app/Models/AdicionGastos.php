<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdicionGastos extends Model
{
    use HasFactory;
    protected $fillable = ['idcompra', 'idgastos', 'costo'];

    public $timestamps = false;

    public function compra()
    {
        return $this->belongsTo(Compras::class, 'idcompra');
    }

    public function tipoGasto()
    {
        return $this->belongsTo(TipoGastos::class, 'idgastos');
    }
}
