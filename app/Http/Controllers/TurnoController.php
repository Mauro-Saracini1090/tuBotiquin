<?php

namespace App\Http\Controllers;

use App\Models\Turno;
use App\Http\Controllers\Controller;
use App\Models\Sucursal;
use Illuminate\Http\Request;

class TurnoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $sucursales = Sucursal::where("borrado_logico_sucursal", "=", "0")->where('habilitado', "=" , "1")->get();
        $turnos = Turno::all();
        return view('admin.turno.calendario',compact('sucursales','turnos'));
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
        //$request->all();
        $turno = Turno::where('fecha_turno', $request->turnoFecha)->first();
        if(isset($turno)){
            $turno->getSucursales()->detach();
        }else{
            $turno  = new Turno();
            $turno->fecha_turno = $request->turnoFecha;
            $turno->usuario_id = $request->usuario;
            $turno->save();   
        }
        if ($request->arrSu != null) {
            foreach ($request->arrSu as $sucur) {
                $sucursal = Sucursal::where('id_sucursal', $sucur)->first();
                $turno->getSucursales()->attach($sucursal);
                // $usuario->getPermisos()->attach($permiso);
                // $usuario->save();
            }
        }

        return redirect(route('turno.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Turno  $turno
     * @return \Illuminate\Http\Response
     */
    public function show(Turno $turno)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Turno  $turno
     * @return \Illuminate\Http\Response
     */
    public function edit(Turno $turno)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Turno  $turno
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Turno $turno)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Turno  $turno
     * @return \Illuminate\Http\Response
     */
    public function destroy(Turno $turno)
    {
        //
    }
}
