<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\User;

class ApiUserController extends Controller
{
    //
    public function index() {
      $clientes = User::where('tipo_id', 2)->get(['codigo', 'nombre', 'apellido', 'telefono', 'tipo_lista']);

      return response()->json($clientes);
    }
}
