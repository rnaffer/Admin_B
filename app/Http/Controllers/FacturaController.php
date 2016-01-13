<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\User;
use App\Empresa;
use App\Factura;
use App\DetalleFactura;
use App\Producto;
use App\Kardex;

class FacturaController extends Controller
{
    //
  public function __construct() {
    $this->middleware('auth');
  }
    
 	public function index() {
		$breadcrumb = 'Facturas';
		$header = 'Facturas';

   	return view('facturas.index', compact('header', 'breadcrumb'));
  }

  public function nuevo()
  {
  	$header = '';
	  $breadcrumb = 'Nueva Factura';
	  $accion = 'Crear Factura';

	  $empresa = Empresa::where('id', 1)->first();
	  $codigo = ((int) $empresa->conse_factura) + 1;
    $existe = Factura::where('codigo', $codigo)->first();

    if ($existe) {
      DetalleFactura::where('factura_id', $codigo)->delete();
    }

	  return view('facturas.new', compact('header', 'breadcrumb', 'codigo', 'accion'));
  }

  public function guardar(Request $request)
  {
    $codigo = $request->input('codigo');
    $factura = Factura::where('codigo', $codigo)->first();

    $factura->subtotal = $request->input('Esubtotal');
    $factura->total = $request->input('Etotal');
    $factura->forma = $request->input('forma');
    $factura->modo = $request->input('modo');
    $factura->descuento = $request->input('descuento');

    $detalles = DetalleFactura::where('factura_id', $factura->codigo)->get();

    foreach ($detalles as $key => $value) {
      $producto = Producto::where('codigo', $value->producto_id)->first();
      $producto->costo = $value->precio;
      $producto->stock -= $value->cantidad;
      $producto->save();
    }

    $factura->estado = 1;
    $factura->save();

    $kardex = new Kardex();
    $kardex->factcmp_id = $factura->codigo;
    $kardex->tipo_entrdsald = 2;
    $kardex->estado = 1;
    $kardex->save();

    $empresa = Empresa::where('id', 1)->first();
    $empresa->conse_factura = $factura->codigo;
    $empresa->save();

    $msg = 'Se ha guardado la factura.';

    return redirect()->route('facturas')->with('status', $msg);
  }
}
