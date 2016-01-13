<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    //
    protected $table = 'producto';

    public function grupo()
    {
        return $this->belongsTo(Grupo::class, 'marca_id', 'codigo');
    }
}
