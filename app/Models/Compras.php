<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Compras extends Model
{
    use HasFactory;

    protected $fillable = ['fecha', 'total', 'totalAG', 'idalmacen'];

    public function detCompras()
    {
        return $this->hasMany(DetCompras::class, 'idcompra');
    }

    public function almacen()
    {
        return $this->belongsTo(Almacenes::class, 'idalmacen');
    }
}
