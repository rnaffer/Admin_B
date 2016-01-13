<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Grupo;
use App\Empresa;
use App\Producto;
use App\Color;

class ProductoController extends Controller
{
    //
    public function __construct() {
      $this->middleware('auth');
    }

    public function index() {

      $header = 'Productos';
      $breadcrumb = 'Productos';

      return view('productos.index', compact('header', 'breadcrumb'));
    }

    public function nuevo() {

      $header = 'Nuevo Producto';
      $breadcrumb = 'Nuevo Producto';
      $accion = 'Crear Producto';
      $padres = Grupo::where('tipo', 1)->get();

      $empresa = Empresa::where('id', 1)->first();
      $codigo = ((int) $empresa->conse_productos) + 1;
      $colores = Color::all();

      return view('productos.new', compact('header', 'breadcrumb', 'padres', 'codigo', 'colores', 'accion'));
    }

    public function guardar(Request $request) {

      $this->validate($request, [
        'nombre' => 'required',
        'codigo' => 'required|numeric',
        'descripcion' => 'required',
        'padre' => 'required|numeric',
        'hijo' => 'required|numeric',
        'costo' => 'required|numeric',
        'pvp1' => 'required|numeric',
        'pvp2' => 'required|numeric',
        'pvp3' => 'required|numeric',
        'color' => 'required',
      ]);

      $codigo = $request->input('codigo');
      $existe = Producto::where('codigo', $codigo)->first();

      if ($request->input('edit') && isset($existe)) {
        $producto = $existe;
        $msg = 'Se ha editado el producto ' . $producto->nombre;
      } else {
        if (isset($existe)) {
          return redirect()->route('productos_nuevo')
                ->withErrors(['El código ingresado ya existe.']);
        }

        $producto = new Producto();
        $msg = 'Se ha creado el producto ';
      }      

      $producto->codigo = $request->input('codigo');
      $producto->nombre = $request->input('nombre');
      $producto->descripcion = $request->input('descripcion');
      $producto->marca_id = $request->input('hijo');
      $producto->costo = $request->input('costo');
      $producto->pvp1 = $request->input('pvp1');
      $producto->pvp2 = $request->input('pvp2');
      $producto->pvp3 = $request->input('pvp3');
      $producto->pvp4 = $request->input('pvp4');
      $producto->pvp5 = $request->input('pvp5');
      $producto->color = $request->input('color');
      $producto->estado = 1;

      $producto->save();

      if (!$request->input('edit')) {
        $empresa = Empresa::where('id', 1)->first();
        $empresa->conse_productos = $producto->codigo;

        $empresa->save();
      }
      
      return redirect()->route('productos')->with('status', $msg);
    }

    public function editar($id)
    {
      $header = 'Editar Producto';
      $breadcrumb = 'Editar Producto';
      $accion = 'Guardar';
      $producto = Producto::where('codigo', $id)->first();
      $grupo = Grupo::where('codigo', $producto->marca_id)->first();
      $padreGrupo = Grupo::where('id', $grupo->tipo)->first();
      $hijos = Grupo::where('tipo', $padreGrupo->id)->get();
      $padres = Grupo::where('tipo', 1)->get();
      $colores = Color::all();

      return view('productos.edit', compact('header', 'breadcrumb', 'padres', 'padreGrupo', 'hijos', 'producto', 'accion', 'colores'));
    }

    public function existe($codigo) {

      $producto = Producto::where('codigo', $codigo)->first();
      $existe = isset($producto);

      return response()->json(array('existe' => $existe));
    }

    public function getdata()
    {
      $productos = Producto::where('estado', 1)->orderBy('nombre', 'asc')->get();

      $all = collect();

      foreach ($productos as $key => $value) { 
        
        $item = array('id' => $value->codigo,
                      'nombre' => $value->nombre,
                      'costo' => $value->costo,
                      'pvp1' => $value->pvp1,
                      'pvp2' => $value->pvp2,
                      'pvp3' => $value->pvp3,
                      'pvp4' => $value->pvp4,
                      'pvp5' => $value->pvp5,
                      );

        $all->push($item);
      }

      return response()->json($all);
    }
}
