<?php

namespace App\Http\Controllers;

use App\Models\Permiso;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PermisosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $permisos = Permiso::orderBy('id_permiso')->get();
        return view('admin.permisos.listaPermisos',compact('permisos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('admin.permisos.crearPermiso');
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
        $permiso = new Permiso();
        $permiso->nombre_permiso = $request->nombre_perm;
        $permiso->slug_permiso = $request->slug_perm;
        $permiso->save();

        return redirect(route('permisos.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Permiso  $permiso
     * @return \Illuminate\Http\Response
     */
    public function show(Permiso $permiso)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Permiso  $permiso
     * @return \Illuminate\Http\Response
     */
    public function edit(Permiso $permiso)
    {
        //
        return view('admin.permisos.editarPermiso',compact('permiso'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Permiso  $permiso
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Permiso $permiso)
    {
        //

        $permiso->nombre_permiso = $request->nombre_perm;
        $permiso->slug_permiso = $request->slug_perm;
        $permiso->save();

        return redirect(route('permisos.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Permiso  $permiso
     * @return \Illuminate\Http\Response
     */
    public function destroy(Permiso $permiso)
    {
        //
        $permiso->delete();
        return redirect(route('permisos.index'));
    }
}
