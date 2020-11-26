<?php

namespace App\Http\Controllers;

use App\Models\Medicamento;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class MedicamentoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $medicamentos = Medicamento::all();
        return view('admin.medicamento.index',compact('medicamentos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('admin.medicamento.crearMedicamento');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //dd($request);
        // $request->validate(([
        //     'nombre_medicamento' => 'required',
        //     'indicaciones' => 'required',
        //     'contradicciones' => 'required',
        //     'composicion	' => 'required',
        //     'posologia' => 'required',
        // ]));
        
        $medicamento = new Medicamento();
        $medicamento->nombre_medicamento = $request->nombre_medicamento;
        $medicamento->indicaciones = $request->indicaciones;
        $medicamento->contradicciones = $request->contradicciones;
        $medicamento->composicion = $request->composicion;
        $medicamento->posologia = $request->posologia;
        $medicamento->save();
        return redirect(route('medicamentos.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Medicamento  $medicamento
     * @return \Illuminate\Http\Response
     */
    public function show(Medicamento $medicamento)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Medicamento  $medicamento
     * @return \Illuminate\Http\Response
     */
    public function edit(Medicamento $medicamento)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Medicamento  $medicamento
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Medicamento $medicamento)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Medicamento  $medicamento
     * @return \Illuminate\Http\Response
     */
    public function destroy(Medicamento $medicamento)
    {
        //
    }
}
