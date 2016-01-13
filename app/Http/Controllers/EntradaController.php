<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\User;
use App\Entrada;
use App\DetalleEntrada;
use App\Empresa;
use App\Producto;
use App\Kardex;

class EntradaController extends Controller
{
    //
  public function __construct() {
    $this->middleware('auth');
  }
    
 	public function index() {
		$breadcrumb = 'Entradas';
		$header = 'Entradas';

   	return view('entradas.index', compact('header', 'breadcrumb'));
  }

  public function nuevo()
  {
  	$header = '';
	  $breadcrumb = 'Nueva Entrada';
	  $accion = 'Crear Entrada';

	  $empresa = Empresa::where('id', 1)->first();
    $productos = Producto::all();
	  $proveedores = User::where('tipo_id', 3)->get();
	  $codigo = ((int) $empresa->conse_entrada) + 1;
    $existe = Entrada::where('codigo', $codigo)->first();

    if ($existe) {
      DetalleEntrada::where('compra_id', $codigo)->delete();
    }

	  return view('entradas.new', compact('header', 'breadcrumb', 'codigo', 'accion', 'proveedores', 'productos'));
  }

  public function guardar(Request $request)
  {
    $codigo = $request->input('codigo');
    $entrada = Entrada::where('codigo', $codigo)->first();

    $entrada->base_grava = $request->input('Esubtotal');
    $entrada->total = $request->input('Etotal');

    $detalles = DetalleEntrada::where('compra_id', $entrada->codigo)->get();

    foreach ($detalles as $key => $value) {
      $producto = Producto::where('codigo', $value->producto_id)->first();
      $producto->stock += $value->cantidad;
      $producto->save();
    }

    $entrada->estado = 1;
    $entrada->save();

    $kardex = new Kardex();
    $kardex->factcmp_id = $entrada->codigo;
    $kardex->tipo_entrdsald = 1;
    $kardex->estado = 1;
    $kardex->save();

    $empresa = Empresa::where('id', 1)->first();
    $empresa->conse_entrada = $entrada->codigo;
    $empresa->save();

    $msg = 'Se ha guardado la entrada.';

    return redirect()->route('entradas')->with('status', $msg);
  }
}
