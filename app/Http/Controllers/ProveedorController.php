<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Empresa;
use App\Estado;
use App\Ciudad;
use App\User;

class ProveedorController extends Controller
{
    //
    public function __construct() {
      $this->middleware('auth');
    }
    
	 	public function index() {
			$breadcrumb = 'Proveedores';
			$header = 'Proveedores';    

	   	return view('proveedores.index', compact('header', 'breadcrumb'));
	  }

	  public function nuevo() {

      $header = 'Nuevo Proveedor';
      $breadcrumb = 'Nuevo Proveedor';
      $accion = 'Crear Proveedor';

      $empresa = Empresa::where('id', 1)->first();
      $estados = Estado::all();
      $codigo = ((int) $empresa->conse_proveedor) + 1;

      return view('proveedores.new', compact('header', 'breadcrumb', 'codigo', 'accion', 'estados'));
    }

    public function guardar(Request $request) {

      $this->validate($request, [
        'nombre' => 'required',
        'codigo' => 'required',
        'ruc' => 'required',
        'ciudad' => 'required',
        'telefono' => 'required',
        'direccion' => 'required',
      ]);

      $codigo = $request->input('codigo');
      $existe = User::where('codigo', $codigo)->where('tipo_id', 3)->first();

      if ($request->input('edit') && isset($existe)) {
        $proveedor = $existe;
        $msg = 'Se ha editado el proveedor ' . $proveedor->nombre;
      } else {
        if (isset($existe)) {
          return redirect()->route('proveedores_nuevo')
                ->withErrors(['El código ingresado ya existe.']);
        }

        $proveedor = new User();
        $msg = 'Se ha creado el proveedor.';
      }      

      $proveedor->codigo = $request->input('codigo');
      $proveedor->nombre = $request->input('nombre');
      $proveedor->ruc = $request->input('ruc');
      $proveedor->ciudad_id = $request->input('ciudad');
      $proveedor->telefono = $request->input('telefono');
      $proveedor->celular = $request->input('celular');
      $proveedor->email = $request->input('email');
      $proveedor->direccion = $request->input('direccion');
      $proveedor->tipo_id = 3;

      $proveedor->save();

      if (!$request->input('edit')) {
        $empresa = Empresa::where('id', 1)->first();
        $empresa->conse_proveedor = $proveedor->codigo;

        $empresa->save();
      }
      
      return redirect()->route('proveedores')->with('status', $msg);
    }

    public function editar($id)
    {
      $header = 'Editar Proveedor';
      $breadcrumb = 'Editar Proveedor';
      $accion = 'Guardar';
      $estados = Estado::all();
      $proveedor = User::where('codigo', $id)->where('tipo_id', 3)->first();
      $ciudadProveedor = Ciudad::where('id', $proveedor->ciudad_id)->first();
      $estadoProveedor = Estado::where('id', $ciudadProveedor->departamento_id)->first();
      $ciudades = Ciudad::where('departamento_id', $estadoProveedor->id)->get();

      return view('proveedores.edit', compact('header', 'breadcrumb', 'estados', 'estadoProveedor', 'proveedor', 'accion', 'ciudades'));
    }
}
