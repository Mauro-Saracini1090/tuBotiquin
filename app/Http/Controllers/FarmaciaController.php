<?php

namespace App\Http\Controllers;

use App\Models\Farmacia;
use APP\Models\Sucursal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use League\CommonMark\Inline\Element\Strong;

class FarmaciaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('farmaceutico.indexFarmaceutico');
    }

    public function listarFarmacias()
    {
        //Obtengo todas las farmacias cargadas en la DB y habilidatas
        $farmacias = Farmacia::where("habilitada", "=", 1)->simplePaginate(6);
        return view('farmacia.farmacias', ['arrayFarmacias' => $farmacias]);

    }    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // Retorna a la vista para cargar una nueva Farmacia a traves de  un formulario
       //return view('farmaceutico.cargarFarmacia');
       return view('farmaceutico.cargarFarmacia'); 
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //Valida los campos 
        Request()->validate(([
            
        'nombre_farmacia' => 'required',
        'img_farmacia' => 'required|image|max:4096',
        'cuit' => 'required',
        ]));

        // Crear una nueva instacia de Farmacia y la guarda en la DB
        $habilitada = 0; // FLAG deshabilitada por defecto
        $id_usuario = auth()->user()->id_usuario;
        
        $farmacia = new Farmacia();
        $farmacia->id_usuario = $id_usuario;
        $farmacia->nombre_farmacia = $request->nombre_farmacia;

        $img_logo = $request->file('img_farmacia')->store('public/img_farmacias');  
        $img_farmacia = Storage::url($img_logo);

        $farmacia->img_farmacia = $img_farmacia;
        $farmacia->descripcion_farmacia = $request->descripcion_farmacia;
        $farmacia->cuit = $request->cuit;
        $farmacia->habilitada = $habilitada;
        $farmacia->save();

             
        return redirect(route('farmacia.index'));
    }
    

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Farmacia  $farmacia
     * @return \Illuminate\Http\Response
     */
    public function show(Farmacia $farmacia)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Farmacia  $farmacia
     * @return \Illuminate\Http\Response
     */
    public function edit(Farmacia $farmacia)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Farmacia  $farmacia
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Farmacia $farmacia)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Farmacia  $farmacia
     * @return \Illuminate\Http\Response
     */
    public function destroy(Farmacia $farmacia)
    {
        //
    }
}
