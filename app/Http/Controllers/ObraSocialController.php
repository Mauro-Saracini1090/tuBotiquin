<?php

namespace App\Http\Controllers;

use App\Models\ObraSocial;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Farmacia;

class ObraSocialController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        //Obtengo todas las localidades cargadas en la DB
        $arrayObraSocial = ObraSocial::orderBy('nombre_obra_social', 'asc')->get();
        return view('obrasocial.indexobrasocial', ['arrayObraSocial' => $arrayObraSocial]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ObraSocial  $obraSocial
     * @return \Illuminate\Http\Response
     */
    public function show(ObraSocial $obraSocial)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ObraSocial  $obraSocial
     * @return \Illuminate\Http\Response
     */
    public function edit(ObraSocial $obraSocial)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ObraSocial  $obraSocial
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ObraSocial $obraSocial)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ObraSocial  $obraSocial
     * @return \Illuminate\Http\Response
     */
    public function destroy(ObraSocial $obraSocial)
    {
        //
    }

    /**
     * Funcion para mostrar las farmacias del usuario farmaceutico logeado,
     * envia el arreglo 
     */
    public function listarObraSocialFarmacia()
    {
        $id_usuario = Auth()->user()->id_usuario;
        $arrayFarmacias = Farmacia::where("id_usuario", "=", $id_usuario)->get();

        $arrayObraSocial = ObraSocial::orderBy('nombre_obra_social', 'asc')->get();

        return view('obrasocial.cargarObraSocialFarmacia', [
            'arrayFarmacias' => $arrayFarmacias,
            'arrayObraSocial' => $arrayObraSocial,
        ]);
    }


    public function agregarObrasocialFarmacia(Request $request)
    {

        if ($request->ajax()){
           
            $farmacia = Farmacia::where('id_farmacia',$request->farmacia_id)->first();
            $obs = $farmacia->obrasSociales;
            return $obs;
        }
        
        $arrayObrasSociales = $request->id_obra_social;
        $id_farmacia = $request->id_farmacia;
        $farmacia = Farmacia::find($id_farmacia);
        $farmacia->obrasSociales()->detach();
        foreach ($arrayObrasSociales as $idObraSocial) {
            $obraSocial = ObraSocial::find($idObraSocial);
            $farmacia->obrasSociales()->attach($obraSocial);
        }
        return redirect(route('farmacia.index'));
    }
}
