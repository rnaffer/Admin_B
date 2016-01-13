<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Grupo;

class ApiGrupoController extends Controller
{
    //
    public function index() {
      $grupos = collect();

      foreach (Grupo::all() as $lote) {
        $tipo = $lote->tipo == 1 ? 'Padre' : 'Hijo';

        $procesado = (object) array(
          'nombre' => $lote->nombre,
          'codigo' => $lote->codigo,
          'tipo' => $tipo
        );

        $grupos->push($procesado);
      }

      return response()->json($grupos);
    }

    public function show( $id ) {

    }
}
