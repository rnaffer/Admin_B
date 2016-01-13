<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\User;

class VendedorController extends Controller
{
    //
    public function getdata()
    {
      $clientes = User::where('tipo_id', 4)->orderBy('nombre', 'asc')->get();

      $all = collect();

      foreach ($clientes as $key => $value) { 
        
        $item = array('id' => $value->codigo,
                      'nombre' => $value->nombre . ' ' . $value->apellido
                      );

        $all->push($item);
      }

      return response()->json($all);
    }
}
