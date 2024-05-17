<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Almacenes extends Model
{
    use HasFactory;

    protected $fillable = ['direccion','zona','celular', 'estado'];

    public $timestamps = false;
    
    public function almacenesTelas()
    {
        return $this->hasMany(AlmacenesTelas::class, 'idalmacen');
    }
}
