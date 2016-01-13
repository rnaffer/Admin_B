<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Grupo extends Model
{
    //
    protected $table = 'marca_producto';

    protected $fillable = ['codigo', 'nombre', 'tipo'];

    public function padre()
    {
        return $this->belongsTo(Grupo::class, 'codigo', 'tipo');
    }

    public function hijos()
    {
      return $this->hasMany(Grupo::class, 'tipo', 'codigo');
    }

    public function productos()
    {
      return $this->hasMany(Producto::class, 'marca_id', 'codigo');
    }

    public function esPadre() {
      return $this->tipo_id == 1 ? true : false;
    }
}
