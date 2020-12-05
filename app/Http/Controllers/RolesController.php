<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Http\Controllers\Controller;
use App\Models\Permiso;
use Illuminate\Http\Request;

class RolesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $roles = Role::orderBy('id_rol')->get();
        return view('admin.roles.index', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('admin.roles.crear');
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
            'nombre_rol' => 'required|string',
            'slug_rol' => 'required|string',
        ]);
        $role = new Role();
        $role->nombre_rol = $request->nombre_rol;
        $role->slug_rol = $request->slug_rol;
        $role->save();

        return redirect(route('roles.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function show(Role $role)
    {
        //
        $permisos = Permiso::all();

        return view('admin.roles.show', compact(['role', 'permisos']));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    // public function edit(Role $role)
    // {
    //     //
    //     return view('admin.roles.editar', compact('role'));
    // }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Role $role)
    {
        $request->validate([
            'nombre_rol' => 'required|string',
            'slug_rol' => 'required|string',
        ]);
       
        if (!$request->nombre_rol) {
            $role->getPermisos()->detach();
            if ($request->listadoPermisos) {
                
                $listadoPermisos = $request->listadoPermisos;
                foreach ($listadoPermisos as $permiso) {
                    
                    $role->nombre_rol = $role->nombre_rol;
                    $role->slug_rol = $role->slug_rol;
                    $role->getPermisos()->attach($permiso);
                    $role->save();
                }
                return redirect(route('roles.show',compact('role')));
            }else{
                return redirect(route('roles.show',compact('role')));
            }
        } else {
            $role->nombre_rol = $request->nombre_rol;
            $role->slug_rol = $request->slug_rol;
            $role->save();
            return redirect(route('roles.index'));
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function destroy(Role $role)
    {
        //
        $role->delete();
        return redirect(route('roles.index'));
    }
}
