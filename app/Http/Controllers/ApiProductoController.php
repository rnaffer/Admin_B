<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Producto;

class ApiProductoController extends Controller
{
    //
    public function index() {
      $productos = Producto::where('id', '>', 0)->get(['codigo', 'nombre', 'costo', 'stock', 'pvp1']);

      return response()->json($productos);
    }

    public function show( $id ) {

    }
}
