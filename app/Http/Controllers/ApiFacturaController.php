<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Factura;
use App\DetalleFactura;

class ApiFacturaController extends Controller
{
    //
  public function postAdd(Request $request)
	{
		$codigo = $request->input('codigo');
		$exist = Factura::where('codigo', $codigo)->first();

		if ($exist) {
			$factura = $exist;
		} else {
			$factura = new Factura();
			$factura->codigo = $codigo;
		}

		$factura->cliente_id = $request->input('cliente');
		$factura->vendedor_id = $request->input('vendedor');
		// $factura->created_at = $request->input('fecha');
		$factura->estado = 3;
		$factura->save();

		$detalleFactura = new DetalleFactura();
		$detalleFactura->factura_id = $factura->codigo;
		$detalleFactura->producto_id = $request->input('producto');
		$detalleFactura->precio = $request->input('costo');
		$detalleFactura->cantidad = $request->input('cantidad');
		$detalleFactura->subtotal = (double)$request->input('costo') * (int)$request->input('cantidad');
		$detalleFactura->estado = 1;
		$detalleFactura->save();

		return response()->json((object) array('status' => 'ok', 'codigo' => $detalleFactura->id));
	}

	public function getDetalle($id)
	{
		$detallesFactura = DB::table('detalle_factura')->join('producto', 'detalle_factura.producto_id', '=', 'producto.codigo')
                                       ->select('detalle_factura.id', 'producto.nombre', 'detalle_factura.precio', 'detalle_factura.cantidad', 'detalle_factura.subtotal')
                                       ->where('detalle_factura.factura_id', $id)
                                       ->get();

    $all = collect();

    foreach ($detallesFactura as $key => $value) { 
    	
    	$item = array('id' => $value->id,
    								'nombre' => $value->nombre,
    								'costo_unitario' => $value->precio,
    								'cantidad' => $value->cantidad,
    								'subtotal' => $value->subtotal,
    								'index' => $key+1,
    								);

    	$all->push($item);
    }

		return response()->json($all);
	}

	public function getDelDetalle($id)
	{
		DetalleFactura::where('id', $id)->delete();

		return response()->json((object) array('status' => 'ok'));
	}

	public function getAll()
	{
		$entradas = DB::table('factura')->join('users', 'factura.cliente_id', '=', 'users.id')
                                       ->select('factura.codigo', 'users.nombre', 'factura.descuento', 'factura.updated_at', 'factura.total')
                                       ->where('factura.estado', '!=', 3)
                                       ->get();

    $all = collect();

    foreach ($entradas as $key => $value) { 
    	
    	$item = array('codigo' => 'F' . $value->codigo,
    								'descuento' => $value->descuento,
    								'updated_at' => $value->updated_at,
    								'cliente' => $value->nombre,
    								'total' => $value->total,
    								);

    	$all->push($item);
    }

		return response()->json($all);
	}
}
