<?php

namespace App\Http\Controllers;

use App\Categoria;
use App\Vacante;
use Illuminate\Http\Request;

class CategoriaController extends Controller
{
    public function show(Categoria $categoria)
    {
        // filtrar vacantes por categoria y que la vacante este activa
        $vacantes = Vacante::where('categoria_id', '=', $categoria->id)->where('activa', '=', true)->paginate(10);

        return view('categorias.show')
            ->with('vacantes', $vacantes)
            ->with('categoria', $categoria);
    }
}
