<?php

namespace App\Http\Controllers;

use App\Models\Localidad;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LocalidadController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //Obtengo todas las localidades cargadas en la DB

        $localidades = Localidad::orderBy('nombre_localidad', 'asc')->simplePaginate(4);
        return view('admin.localidad.indexLocalidad', ['localidades' => $localidades]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // Retorna a la vista para crear una nueva localidad
        return view('admin.localidad.crearLocalidad');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Request()->validate(([
            'codigo_postal' => 'required|numeric',
            'nombre_localidad' => 'required',

        ]));
        // Crear una nueva instacia de localidad y la guarda en la DB
        $localidad = new Localidad();
        $localidad->codigo_postal = $request->codigo_postal;
        $localidad->nombre_localidad = $request->nombre_localidad;
        $localidad->save();

        return redirect(route('localidad.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Localidad  $localidad
     * @return \Illuminate\Http\Response
     */
    public function show(Localidad $localidad)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Localidad  $localidad
     * @return \Illuminate\Http\Response
     */
    public function edit(Localidad $localidad)
    {
        //Recibe una instancia de localidad y envia a vista 
        return view('admin.localidad.editarLocalidad', ['localidad' => $localidad]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Localidad  $localidad
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Localidad $localidad)
    {
        //Comprueba que el codigo postal (id de la tabla) no pertenesca a otra localidad
        //FALTA COMPROBAR //

        Request()->validate(([
            'codigo_postal' => 'required|numeric',
            'nombre_localidad' => 'required',

        ]));
            // Recibe una instanacia $localidad y procede a guardar los valores
            $localidad->nombre_localidad = $request->nombre_localidad;
            $localidad->codigo_postal = $request->codigo_postal;
            $localidad->save();
            return redirect(route('localidad.index'));
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Localidad  $localidad
     * @return \Illuminate\Http\Response
     */
    public function destroy(Localidad $localidad)
    {
        //Recibe una instancia de localida y procede a eliminarla de la DB
        $localidad->delete();
        return redirect(route('localidad.index'));
    }
}
