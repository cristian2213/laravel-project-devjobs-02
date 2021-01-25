<?php

namespace App\Http\Controllers;

use App\Skill;
use App\Salario;
use App\Vacante;
use App\Categoria;
use App\Ubicacion;
use App\Experiencia;
use GuzzleHttp\Middleware;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;


class VacanteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $vacantes = Vacante::where('user_id', auth()->user()->id)->simplePaginate(5);

        return view('vacantes.index')
            ->with('vacantes', $vacantes);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // getting the categories, experiences, ubications, gainings
        $categorias = Categoria::all();
        $experiencias = Experiencia::all();
        $ubicaciones = Ubicacion::all();
        $salarios = Salario::all();
        $skills = Skill::all();

        return view('vacantes.create')
            ->with('categorias', $categorias)
            ->with('experiencias', $experiencias)
            ->with('ubicaciones', $ubicaciones)
            ->with('salarios', $salarios)
            ->with('skills', $skills);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //return dd($request->all());

        // validacion de los campos
        $data = $request->validate([
            'titulo' => 'required|min:8',
            'imagen' => 'required',
            'descripcion' => 'required|min:50',
            'skills' => 'required',
            'categoria' => 'required',
            'experiencia' => 'required',
            'ubicacion' => 'required',
            'salario' => 'required'
        ]);

        // guardar en la Db
        auth()->user()->vacantes()->create([
            'titulo' => $data['titulo'],
            'imagen' => $data['imagen'],
            'descripcion' => $data['descripcion'],
            'skills' => $data['skills'],
            'categoria_id' => $data['categoria'],
            'experiencia_id' => $data['experiencia'],
            'ubicacion_id' => $data['ubicacion'],
            'salario_id' => $data['salario']
        ]);

        return redirect()->action('VacanteController@index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Vacante  $vacante
     * @return \Illuminate\Http\Response
     */
    public function show(Vacante $vacante)
    {
        return view('vacantes.show')
            ->with('vacante', $vacante);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Vacante  $vacante
     * @return \Illuminate\Http\Response
     */
    public function edit(Vacante $vacante)
    {
        // para que un usuario no pueda editar la vacante de otro usuario
        $this->authorize('view', $vacante);

        $categorias = Categoria::all();
        $experiencias = Experiencia::all();
        $ubicaciones = Ubicacion::all();
        $salarios = Salario::all();
        $skills = Skill::all();

        return view('vacantes.edit', compact('vacante', 'categorias', 'experiencias', 'ubicaciones', 'salarios', 'skills'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Vacante  $vacante
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Vacante $vacante)
    {
        $this->authorize('update', $vacante);

        $data = $request->validate([
            'titulo' => 'required|min:8',
            'imagen' => 'required',
            'descripcion' => 'required|min:50',
            'skills' => 'required',
            'categoria' => 'required',
            'experiencia' => 'required',
            'ubicacion' => 'required',
            'salario' => 'required'
        ]);


        $vacante->titulo = $data['titulo'];
        $vacante->imagen = $data['imagen'];
        $vacante->descripcion = $data['descripcion'];
        $vacante->skills = $data['skills'];
        $vacante->categoria_id = $data['categoria'];
        $vacante->experiencia_id = $data['experiencia'];
        $vacante->ubicacion_id = $data['ubicacion'];
        $vacante->salario_id = $data['salario'];
        $vacante->save();

        return redirect()->action('VacanteController@index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Vacante  $vacante
     * @return \Illuminate\Http\Response
     */
    public function destroy(Vacante $vacante)
    {
        $this->authorize('delete', $vacante);

        //Vacante::destroy($vacante);
        $vacante->delete();
        return response()->json(["mensaje" => "Se elimino la vacante {$vacante->titulo}"]);
    }

    // metodo para guardar la imagen en el servidor
    public function imagen(Request $request)
    {

        $imagen = $request->file('file'); // acceder a la imagen

        $nombreImagen = time() . '.' . $imagen->extension(); // se genera el nombre de la imagen de acuerdo a la hora que se subio la imagen

        $imagen->move(public_path('storage/vacantes'), $nombreImagen); // luego se mueve el archivo a la carpeta privada y se renombra con el nombre basado en la hora que se creo

        return response()->json(['correcto' => $nombreImagen]);
    }

    public function borrarImagen(Request $request)
    {
        // validar si es un request ajax
        if ($request->ajax()) {
            $imagen = $request->get('imagen');

            // antes de eliminar algo en el servidor se debe primero verificar que exista el archivo
            if (File::exists('storage/vacantes/' . $imagen)) {
                File::delete('storage/vacantes/' . $imagen);
            }

            return response('Imagen Eliminada', 200);
        }
    }

    public function estado(Request $request, Vacante $vacante)
    {
        // recordar responder siempre en formato json
        if ($request->ajax()) {
            $vacante->activa = $request->estado;
            $vacante->save();
            return response()->json(['status' => true]);
        }
    }
}
