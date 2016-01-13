<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\User;

class InformeController extends Controller
{
    //
    public function entradasIndex()
    {
	  	$header = '';
		  $breadcrumb = 'Informes - Entradas';
		  $accion = 'Buscar';

		  $proveedores = User::where('tipo_id', 3)->get();

		  return view('informes.entradas', compact('header', 'breadcrumb', 'accion', 'proveedores'));
    }
}
