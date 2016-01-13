<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\User;

class ApiProveedorController extends Controller
{
    //
    public function index() {
      $proveedores = User::where('tipo_id', 3)->get(['codigo', 'nombre', 'celular', 'telefono', 'email']);

      return response()->json($proveedores);
    }
}
