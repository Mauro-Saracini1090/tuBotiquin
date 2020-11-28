<?php

namespace App\Http\Controllers;

use App\Models\TipoMedicamento;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TipoMedicamentoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $tiposMedicamentos = TipoMedicamento::simplePaginate(7);
        return view('admin.tipoMedicamento.listadoTipo',compact('tiposMedicamentos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('admin.tipoMedicamento.nuevoTipoMedicamento');
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
        $request->validate([
            'nombre_tipo' => 'required'
        ]);

        $tipo = new TipoMedicamento();
        $tipo->nombre_tipo = $request->nombre_tipo;
        $tipo->save();

        return redirect(route('tipoMedicamentos.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\TipoMedicamento  $tipoMedicamento
     * @return \Illuminate\Http\Response
     */
    public function show(TipoMedicamento $tipoMedicamento)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\TipoMedicamento  $tipoMedicamento
     * @return \Illuminate\Http\Response
     */
    public function edit(TipoMedicamento $tipoMedicamento)
    {
        //
        return view('admin.tipoMedicamento.editarTipoMedicamento',compact('tipoMedicamento'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\TipoMedicamento  $tipoMedicamento
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TipoMedicamento $tipoMedicamento)
    {
        //
        $request->validate([
            'nombre_tipo' => 'required'
        ]);

        $tipoMedicamento->nombre_tipo = $request->nombre_tipo;
        $tipoMedicamento->save();

        return redirect(route('tipoMedicamentos.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TipoMedicamento  $tipoMedicamento
     * @return \Illuminate\Http\Response
     */
    public function destroy(TipoMedicamento $tipoMedicamento)
    {
        //

        $tipoMedicamento->delete();
        return redirect(route('tipoMedicamentos.index'));

    }
}
