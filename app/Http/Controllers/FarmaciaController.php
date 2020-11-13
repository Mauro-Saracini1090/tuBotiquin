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


    public function verFarmacia()
    {
        $id_usuario = auth()->user()->id_usuario;
        $arrayFarmacias = array();
        $arrayFarmacias = Farmacia::where("id_usuario", "=", $id_usuario)->get();
        //dd($arrayFarmacias);

       if(!(count($arrayFarmacias) >= 0)){
           $arrayFarmacias = null;
        }
        return view('farmaceutico.verFarmacia', [   'arrayFarmacias' => $arrayFarmacias  ]);
    }

    public function listarFarmacias()
    {
        //Se obtienen todas las farmacias en estado habilitado = 1
        //Se paginan de a 6 elementos para ser mostrados en la vista
        $farmaciasPaginate = Farmacia::where("habilitada", "=", 1)->simplePaginate(6);
        $arrayFarmacias = Farmacia::where("habilitada", "=", 1)->get();

        return view('farmacia.farmacias', [
            'arrayFarmaciasPaginate' => $farmaciasPaginate,
            'arrayFarmacias' => $arrayFarmacias,
            ]);

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
        'img_farmacia' => 'required|image|mimes:jpeg,png|max:4096',
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
    
    //public function farmaciabuscar($nombreFarmacia)
    //{

    //    $farmaciaEncontrada = Farmacia::where("nombre", "=", $nombreFarmacia);
    //    return view('farmacia.farmacias', ['farmaciaEncontradas' => $farmaciaEncontrada]);

    //}

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
       return view('farmaceutico.editarFarmacia', ['farmacia' => $farmacia]);
      
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

       
        Request()->validate(([
            'nombre_farmacia' => 'required',
            'cuit' => 'required',

        ]));
        
        if($request->descripcion_farmacia != null){
            $farmacia->descripcion_farmacia = $request->descripcion_farmacia;
        }
        $farmacia->nombre_farmacia = $request->nombre_farmacia;
        $farmacia->cuit = $request->cuit;
        $farmacia->save();
        return redirect(route('farmacia.index'));
    
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
