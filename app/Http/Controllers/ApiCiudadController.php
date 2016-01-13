<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Ciudad;

class ApiCiudadController extends Controller
{
    //
    public function index($estado_id)
    {
    	$ciudades = Ciudad::where('departamento_id', $estado_id)->get();

    	return response()->json($ciudades);
    }
}
