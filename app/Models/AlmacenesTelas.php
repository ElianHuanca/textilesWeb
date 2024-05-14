<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AlmacenesTelas extends Model
{
    use HasFactory;
    protected $fillable = ['idalmacen', 'idtela', 'stock'];

    public function tela()
    {
        return $this->belongsTo(Telas::class, 'idtela');
    }

    public function almacen()
    {
        return $this->belongsTo(Almacenes::class, 'idalmacen');
    }
}
