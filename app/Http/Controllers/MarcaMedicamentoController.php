<?php

namespace App\Http\Controllers;

use App\Models\MarcaMedicamento;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MarcaMedicamentoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $marcasMedicamentos = MarcaMedicamento::simplePaginate(7);
        return view('admin.marcaMedicamento.listadoMarcas',compact('marcasMedicamentos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('admin.marcaMedicamento.nuevaMarcaMedicamento');
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
            'nombre_marca' => 'required'
        ]);

        $tipo = new MarcaMedicamento();
        $tipo->nombre_marca = $request->nombre_marca;
        $tipo->save();

        return redirect(route('marcaMedicamentos.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\MarcaMedicamento  $marcaMedicamento
     * @return \Illuminate\Http\Response
     */
    public function show(MarcaMedicamento $marcaMedicamento)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\MarcaMedicamento  $marcaMedicamento
     * @return \Illuminate\Http\Response
     */
    public function edit(MarcaMedicamento $marcaMedicamento)
    {
        //
        return view('admin.marcaMedicamento.editarMarcaMedicamento',compact('marcaMedicamento'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\MarcaMedicamento  $marcaMedicamento
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, MarcaMedicamento $marcaMedicamento)
    {
        //
        $request->validate([
            'nombre_marca' => 'required'
        ]);

        $marcaMedicamento->nombre_marca = $request->nombre_marca;
        $marcaMedicamento->save();

        return redirect(route('marcaMedicamentos.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\MarcaMedicamento  $marcaMedicamento
     * @return \Illuminate\Http\Response
     */
    public function destroy(MarcaMedicamento $marcaMedicamento)
    {
        //
        $marcaMedicamento->delete();
        return redirect(route('marcaMedicamentos.index'));
    }
}
