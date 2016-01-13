<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Empresa;
use App\Estado;
use App\Ciudad;
use App\User;

class UserController extends Controller
{
	  //
		public function __construct() {
      $this->middleware('auth');
    }
    
	 	public function index() {
			$breadcrumb = 'Clientes';
			$header = 'Clientes';    

	   	return view('users.index', compact('header', 'breadcrumb'));
	  }

	  public function nuevo() {

      $header = 'Nuevo Cliente';
      $breadcrumb = 'Nuevo Cliente';
      $accion = 'Crear Cliente';

      $empresa = Empresa::where('id', 1)->first();
      $estados = Estado::all();
      $codigo = ((int) $empresa->conse_cliente) + 1;

      return view('users.new', compact('header', 'breadcrumb', 'codigo', 'accion', 'estados'));
    }

    public function guardar(Request $request) {

      $this->validate($request, [
        'nombre' => 'required',
        'codigo' => 'required',
        'apellido' => 'required',
        'ruc' => 'required',
        'ciudad' => 'required',
        'telefono' => 'required',
        'celular' => 'required',
        'email' => 'required',
        'direccion' => 'required',
        'lista' => 'required',
      ]);

      $codigo = $request->input('codigo');
      $existe = User::where('codigo', $codigo)->where('tipo_id', 2)->first();

      if ($request->input('edit') && isset($existe)) {
        $cliente = $existe;
        $msg = 'Se ha editado el Cliente ' . $cliente->nombre . ' ' . $cliente->apellido;
      } else {
        if (isset($existe)) {
          return redirect()->route('clientes_nuevo')
                ->withErrors(['El código ingresado ya existe.']);
        }

        $cliente = new User();
        $msg = 'Se ha creado el cliente.';
      }      

      $cliente->codigo = $request->input('codigo');
      $cliente->nombre = $request->input('nombre');
      $cliente->apellido = $request->input('apellido');
      $cliente->ruc = $request->input('ruc');
      $cliente->ciudad_id = $request->input('ciudad');
      $cliente->telefono = $request->input('telefono');
      $cliente->celular = $request->input('celular');
      $cliente->email = $request->input('email');
      $cliente->direccion = $request->input('direccion');
      $cliente->tipo_lista = $request->input('lista');
      $cliente->tipo_id = 2;

      $cliente->save();

      if (!$request->input('edit')) {
        $empresa = Empresa::where('id', 1)->first();
        $empresa->conse_cliente = $cliente->codigo;

        $empresa->save();
      }
      
      return redirect()->route('clientes')->with('status', $msg);
    }

    public function editar($id)
    {
      $header = 'Editar Cliente';
      $breadcrumb = 'Editar Cliente';
      $accion = 'Guardar';
      $estados = Estado::all();
      $cliente = User::where('codigo', $id)->where('tipo_id', 2)->first();
      $ciudadCliente = Ciudad::where('id', $cliente->ciudad_id)->first();
      $estadoCliente = Estado::where('id', $ciudadCliente->departamento_id)->first();
      $ciudades = Ciudad::where('departamento_id', $estadoCliente->id)->get();

      return view('users.edit', compact('header', 'breadcrumb', 'estados', 'estadoCliente', 'cliente', 'accion', 'ciudades'));
    }

    public function getdata()
    {
      $clientes = User::where('tipo_id', 2)->orderBy('nombre', 'asc')->get();

      $all = collect();

      foreach ($clientes as $key => $value) { 
        
        $item = array('id' => $value->codigo,
                      'nombre' => $value->nombre . ' ' . $value->apellido,
                      'nit' => $value->ruc,
                      'tipo_lista' => $value->tipo_lista
                      );

        $all->push($item);
      }

      return response()->json($all);
    }
}
