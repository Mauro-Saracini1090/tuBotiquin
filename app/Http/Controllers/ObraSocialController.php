<?php

namespace App\Http\Controllers;

use App\Models\ObraSocial;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Farmacia;
use Illuminate\Support\Facades\Gate;

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
        if(\auth()->user()->getRoles->contains('slug_rol','es-administrador')){
            $arrayObraSocial = ObraSocial::simplePaginate(5);
            return view('admin.obrasocial.index', ['arrayObraSocial' => $arrayObraSocial]);
        }

        $arrayObraSocial = ObraSocial::orderBy('nombre_obra_social', 'asc')->simplePaginate(5);
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
        Gate::authorize('esAdmin');
        return view('admin.obrasocial.create');
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
        Gate::authorize('esAdmin');
        Request()->validate(([
            'Nombre_obra_social' => 'required',
            'Telefono_obra_Social' => 'required|numeric',

        ]));
            $obrasocial = new ObraSocial;
            $obrasocial->Nombre_obra_social = $request->Nombre_obra_social;
            $obrasocial->Telefono_obra_Social = $request->Telefono_obra_Social;
            $obrasocial->save();
            return redirect(route('obrasocial.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ObraSocial  $obraSocial
     * @return \Illuminate\Http\Response
     */
    public function show(ObraSocial $obrasocial)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ObraSocial  $obraSocial
     * @return \Illuminate\Http\Response
     */
    public function edit(ObraSocial $obrasocial)
    {
        //
        Gate::authorize('esAdmin');
        return view('admin.obrasocial.edit', compact('obrasocial'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ObraSocial  $obraSocial
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ObraSocial $obrasocial)
    {
        //
        Gate::authorize('esAdmin');
        Request()->validate(([
            'Nombre_obra_social' => 'required',
            'Telefono_obra_Social' => 'required|numeric',

        ]));
            // Recibe una instanacia $localidad y procede a guardar los valores
            $obrasocial->Nombre_obra_social = $request->Nombre_obra_social;
            $obrasocial->Telefono_obra_Social = $request->Telefono_obra_Social;
            $obrasocial->save();
            return redirect(route('obrasocial.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ObraSocial  $obraSocial
     * @return \Illuminate\Http\Response
     */
    public function destroy(ObraSocial $obrasocial)
    {
        //
        Gate::authorize('esAdmin');
       $obrasocial->farmacias()->detach();
       $obrasocial->delete();
       return redirect(route('obrasocial.index'));
    }

    /**
     * Funcion para mostrar las farmacias del usuario farmaceutico logeado,
     * envia el arreglo 
     */
    public function listarObraSocialFarmacia()
    {
        $id_usuario = Auth()->user()->id_usuario;
        $arrayFarmacias = Farmacia::where("id_usuario", "=", $id_usuario)->where("borrado_logico_farmacia", "=", "0")->get();

        $arrayObraSocial = ObraSocial::orderBy('nombre_obra_social', 'asc')->get();

        return view('admin.obrasocial.agregarObraSocialFarmacia', [
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
        return redirect(route('obrasocialfarmacia'));
    }
}
