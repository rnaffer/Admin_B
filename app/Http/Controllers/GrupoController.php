<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Grupo;
use App\Empresa;

class GrupoController extends Controller
{
    //
    public function __construct() {
      $this->middleware('auth');
    }

    public function index() {

      $header = 'Grupos';
      $breadcrumb = 'Grupos';

      return view('grupos.index', compact('header', 'breadcrumb'));
    }

    public function nuevo() {

      $header = 'Nuevo Grupo';
      $breadcrumb = 'Nuevo Grupo';
      $accion = 'Crear Grupo';
      $padres = Grupo::where('tipo', 1)->get();

      $empresa = Empresa::where('id', 1)->first();
      $codigo = ((int) $empresa->conse_grupos) + 1;

      return view('grupos.new', compact('header', 'breadcrumb', 'padres', 'codigo', 'accion'));
    }

    public function guardar(Request $request) {

      $this->validate($request, [
        'nombre' => 'required',
        'codigo' => 'required',
        'tipo' => 'required',
      ]);

      $tipo = $request->input('tipo');
      $padre = $request->input('padre');

      if ($tipo == 2 && !isset($padre)) {
        return redirect()->route('grupos_nuevo')
              ->withErrors(['Si el grupo es hijo, debe indicar un grupo padre.']);
      }

      if ($request->input('edit')) {
        $grupo = Grupo::where('codigo', $request->input('codigo'))->first();
        $msg = 'Se ha editado el grupo ' . $request->input('nombre');
      } else {
        $grupo = new Grupo();
        $msg = 'Se ha creado el grupo ' . $request->input('nombre');
      }

      $grupo->nombre = $request->input('nombre');
      $grupo->codigo = $request->input('codigo');
      $grupo->tipo = ($tipo == 1) ? 1 : $padre;

      $grupo->save();

      if (!$request->input('edit')) {
        $empresa = Empresa::where('id', 1)->first();
        $empresa->conse_grupos = $grupo->codigo;

        $empresa->save();
      }

      return redirect()->route('grupos')->with('status', $msg);
    }

    public function editar($id)
    {
      $header = 'Editar Grupo';
      $breadcrumb = 'Editar Grupo';
      $accion = 'Guardar';
      $grupo = Grupo::where('codigo', $id)->first();
      $padres = Grupo::where('tipo', 1)->get();

      return view('grupos.edit', compact('header', 'breadcrumb', 'padres', 'grupo', 'accion'));
    }

    public function hijos($padre_id) {

      $hijos = Grupo::where('tipo', $padre_id)->get();

      return response()->json($hijos);
    }
}
