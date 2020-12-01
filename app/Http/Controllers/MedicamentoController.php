<?php

namespace App\Http\Controllers;

use App\Models\Medicamento;
use App\Http\Controllers\Controller;
use App\Models\MarcaMedicamento;
use App\Models\TipoMedicamento;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;

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
        return view('admin.medicamento.index', compact('medicamentos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $tipos = TipoMedicamento::all();
        $marcas = MarcaMedicamento::all();
        return view('admin.medicamento.crearMedicamento', compact('tipos', 'marcas'));
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
        $request->validate([
            'nombre_medicamento' => 'required',
            'informacion' => 'required',
            'id_marca' => 'required',
            'id_tipo' => 'required',
            'img_medicamento' => 'required|image|mimes:jpeg,jpe,png|max:4096',
        ], [
            'id_marca.required' => 'Es obligatorio seleccionar una Marca de Medicamento',
            'id_tipo.required' => 'Es obligatorio seleccionar un Tipo de Medicamento',
        ]);

        $medicamento = new Medicamento();
        $medicamento->nombre_medicamento = $request->nombre_medicamento;
        $medicamento->informacion = $request->informacion;
        $medicamento->marca_id = $request->id_marca;
        $medicamento->tipo_id = $request->id_tipo;

        $img_logo = $request->file('img_medicamento')->store('public/img_medicamento');
        $img_farmacia = Storage::url($img_logo);

        $medicamento->img_medicamento = $img_farmacia;

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
        return view('admin.medicamento.detalleMedicamento', compact('medicamento'));
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
        $tipos = TipoMedicamento::all();
        $marcas = MarcaMedicamento::all();
        return view('admin.medicamento.editarMedicamento', compact('tipos', 'marcas','medicamento'));
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
        $request->validate([
            'nombre_medicamento' => 'required',
            'informacion' => 'required',
            'id_marca' => 'required',
            'id_tipo' => 'required',
        ], [
            'id_marca.required' => 'Es obligatorio seleccionar una Marca de Medicamento',
            'id_tipo.required' => 'Es obligatorio seleccionar un Tipo de Medicamento',
        ]);

        $medicamento->nombre_medicamento = $request->nombre_medicamento;
        $medicamento->informacion = $request->informacion;
        $medicamento->marca_id = $request->id_marca;
        $medicamento->tipo_id = $request->id_tipo;
        $medicamento->save();
        return redirect(route('medicamentos.index'));
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
        $medicamento->delete();
        return redirect(route('medicamentos.index'));
    }
}
