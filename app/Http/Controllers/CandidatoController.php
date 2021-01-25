<?php

namespace App\Http\Controllers;

use App\Vacante;
use App\Candidato;
use Illuminate\Http\Request;
use App\Notifications\NuevoCandidato; // clase de envio de emails

class CandidatoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $id_vacante = intval($request->route('id')); // obtener el parametro de una ruta

        // verificar que la vacante exista
        $vacante = Vacante::findOrFail($id_vacante);

        $this->authorize('view', $vacante);

        return view('candidatos.index', compact('vacante'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'nombre' => 'required',
            'email' => 'required|email',
            'cv' => 'required|mimes:pdf|max:5000',
            'vacante_id' => 'required'
        ]);

        //* forma de agregar a la db #1
        //$candidato = new Candidato();
        //$candidato->nombre = $data['nombre'];
        //$candidato->email = $data['email'];
        //$candidato->cv = '123.jpg';
        //$candidato->vacante_id = $data['vacante_id'];
        //$candidato->save();

        //* forma de agregar a la db #2
        //$candidato = new Candidato($data);
        //$candidato->cv = '1234.jpg';
        //$candidato->save();

        //* forma de agregar a la db #3
        //$candidato = new Candidato();
        //$candidato->fill($data);
        //$candidato->cv = '12345.jpg';
        //$candidato->save();

        // Almacenar archvio pdf
        if ($request->file('cv')) {
            $archivo = $request->file('cv'); // obtener el archivo
            $nombreArchivo = time() . "." . $request->file('cv')->extension(); // renombrar el archivo para que no se repita

            $ubicacion = public_path('/storage/cv'); // ubicacion en la cual se va a guardar el archivo
            $archivo->move($ubicacion, $nombreArchivo); // mover el archivo a la ubicacion indicada
            $data['cv'] = $nombreArchivo;
        }

        //* forma de agregar a la db #4 (usando relacion)
        $vacante = Vacante::find($data['vacante_id']);
        // si se llama a la relacion sin parentesis se accede a toda la informacin de la collecion de datos, si se hace como una funcion entonces se tiene acceso a todos los metodos como por ejemplo el create
        $vacante->candidatos()->create([
            'nombre' => $data['nombre'],
            'email' => $data['email'],
            'cv' => $data['cv'],
            'vacante_id' => $data['vacante_id'],
        ]);

        // enviar email al dueño de la vacante
        $reclutador = $vacante->reclutador;
        $reclutador->notify(new NuevoCandidato($vacante->titulo, $vacante->id)); //pasando datos al contructor

        return back()->with('estado', 'Tus datos se enviaros correctamente! Suerte'); // redirige a la pagian previa
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Candidato  $candidato
     * @return \Illuminate\Http\Response
     */
    public function show(Candidato $candidato)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Candidato  $candidato
     * @return \Illuminate\Http\Response
     */
    public function edit(Candidato $candidato)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Candidato  $candidato
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Candidato $candidato)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Candidato  $candidato
     * @return \Illuminate\Http\Response
     */
    public function destroy(Candidato $candidato)
    {
        //
    }
}
