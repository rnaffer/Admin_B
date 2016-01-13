<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Color;

class ApiColoresController extends Controller
{
    //
    public function index() {
      $colores = Color::all();

      return response()->json($colores);
    }
}
