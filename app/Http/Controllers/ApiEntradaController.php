<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Producto;
use App\Entrada;
use App\DetalleEntrada;

class ApiEntradaController extends Controller
{
    //
	public function postAdd(Request $request)
	{
		$codigo = $request->input('codigo');
		$exist = Entrada::where('codigo', $codigo)->first();

		if ($exist) {
			$entrada = $exist;
		} else {
			$entrada = new Entrada();
			$entrada->codigo = $codigo;			
		}
		
		$entrada->proveedor_id = $request->input('proveedor');
		$entrada->codigo_guia_compra = $request->input('factura');
		// $entrada->created_at = $request->input('fecha');
		$entrada->concepto = $request->input('concepto');
		$entrada->estado = 3;
		$entrada->save();

		$detalleEntrada = new DetalleEntrada();
		$detalleEntrada->compra_id = $entrada->codigo;
		$detalleEntrada->producto_id = $request->input('producto');
		$detalleEntrada->costo_unitario = $request->input('costo');
		$detalleEntrada->cantidad = $request->input('cantidad');
		$detalleEntrada->subtotal = (double)$request->input('costo') * (int)$request->input('cantidad');
		$detalleEntrada->estado = 1;
		$detalleEntrada->save();

		$producto = Producto::where('codigo', $detalleEntrada->producto_id)->first();
    $producto->costo = $detalleEntrada->costo_unitario;
    $producto->save();

		return response()->json((object) array('status' => 'ok', 'codigo' => $detalleEntrada->id));

	}


	public function postFlete(Request $request)
	{
		$codigo = $request->input('codigo');
		$total = $request->input('total');
		$flete = $request->input('flete');

		$porcentajeDetalle = $flete / $total;

		$detalles = DetalleEntrada::where('compra_id', $codigo)->get();

		foreach ($detalles as $detalle) {

			$flete_detalle = $detalle->subtotal * $porcentajeDetalle;

			$producto = Producto::where('codigo', $detalle->producto_id)->first();
			
			$flete_unitario = round($flete_detalle / $detalle->cantidad, 3);

			$producto->costo_flete = $flete_unitario;
			$producto->save();
		}

		return response()->json((object) array('status' => 'ok'));
	}

	public function getDetalle($id)
	{
		$detallesEntrada = DB::table('detalle_compra')->join('producto', 'detalle_compra.producto_id', '=', 'producto.codigo')
                                       ->select('detalle_compra.id', 'producto.nombre', 'producto.costo_flete', 'detalle_compra.costo_unitario', 'detalle_compra.cantidad', 'detalle_compra.subtotal')
                                       ->where('detalle_compra.compra_id', $id)
                                       ->get();

    $all = collect();

    foreach ($detallesEntrada as $key => $value) {

    	if ($value->costo_flete !== 0) {
    		$flete =  ($value->cantidad * $value->costo_flete) + ($value->cantidad * $value->costo_flete * 0.16);
    	} else {
    		$flete = 0;
    	}
    	
    	$item = array('id' => $value->id,
    								'nombre' => $value->nombre,
    								'costo_unitario' => $value->costo_unitario,
    								'cantidad' => $value->cantidad,
    								'subtotal' => $value->subtotal,
    								'flete' => round($flete, 3),
    								'index' => $key+1,
    								);

    	$all->push($item);
    }

		return response()->json($all);
	}

	public function getDelDetalle($id)
	{
		DetalleEntrada::where('id', $id)->delete();

		return response()->json((object) array('status' => 'ok'));
	}

	public function getAll()
	{
		$entradas = DB::table('compra')->join('users', 'compra.proveedor_id', '=', 'users.id')
                                       ->select('compra.codigo', 'users.nombre', 'compra.concepto', 'compra.updated_at', 'compra.total')
                                       ->where('compra.estado', '!=', 3)
                                       ->get();

    $all = collect();

    foreach ($entradas as $key => $value) { 
    	
    	$item = array('codigo' => 'E' . $value->codigo,
    								'concepto' => $value->concepto,
    								'updated_at' => $value->updated_at,
    								'proveedor' => $value->nombre,
    								'total' => $value->total,
    								);

    	$all->push($item);
    }

		return response()->json($all);
	}

	public function search($fecha_inicial, $fecha_final, $proveedor)
	{

		if ($proveedor !== '0') {

			$entradas = DB::table('compra')->join('users', 'compra.proveedor_id', '=', 'users.id')
                                     ->select('compra.codigo', 'users.nombre', 'compra.concepto', 'compra.updated_at', 'compra.total')
                                     ->where('compra.estado', '!=', 3)
                                     ->where('compra.created_at', '>=', $fecha_inicial)
                                     ->where('compra.created_at', '<=', $fecha_final)
                                     ->where('compra.proveedor_id', $proveedor)
                                     ->get();

		} else {

			$entradas = DB::table('compra')->join('users', 'compra.proveedor_id', '=', 'users.id')
                                     ->select('compra.codigo', 'users.nombre', 'compra.concepto', 'compra.updated_at', 'compra.total')
                                     ->where('compra.estado', '!=', 3)
                                     ->where('compra.created_at', '>=', $fecha_inicial)
                                     ->where('compra.created_at', '<=', $fecha_final)
                                     ->get();
		}

    $all = collect();

    foreach ($entradas as $key => $value) { 
    	
    	$item = array('codigo' => 'E' . $value->codigo,
    								'concepto' => $value->concepto,
    								'updated_at' => $value->updated_at,
    								'proveedor' => $value->nombre,
    								'total' => $value->total,
    								);

    	$all->push($item);
    }

		return response()->json($all);
	}
}
