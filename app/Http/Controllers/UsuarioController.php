<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use App\Http\Controllers\Controller;
use App\Models\Localidad;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class UsuarioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        // if (Gate::denies('esAdmin')) {
        //     abort(403);
        // }
        $usuarios = Usuario::all();
        return view('admin.usuario.listaUsuarios', compact('usuarios'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        //

        $localidades = Localidad::all();
        return view('admin.usuario.crearUsuario', compact('localidades'));
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
        if ($request->habilitado == 'si') {
            $habilitado = true;
        } else {
            $habilitado = false;
        }

        $usuario = new Usuario();
        $usuario->nombre = $request->nombre;
        $usuario->apellido = $request->apellido;
        $usuario->nombre_usuario = $request->nombreUsuario;
        $usuario->email = $request->email;
        $usuario->password = $request->password;
        $usuario->cod_postal = $request->localidad;
        $usuario->cuil = $request->cuil;
        $usuario->cuit = $request->cuit;
        $usuario->dni = $request->dni;
        $usuario->numero_matricula = $request->matricula;
        $usuario->habilitado = $habilitado;
        $usuario->save();

        return redirect(route('usuario.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Usuario  $usuario
     * @return \Illuminate\Http\Response
     */
    public function show(Usuario $usuario)
    {
        //
        $this->authorize('view', $usuario);
        
        return view('admin.usuario.verUsuario', compact('usuario'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Usuario  $usuario
     * @return \Illuminate\Http\Response
     */
    public function edit(Usuario $usuario)
    {
        //
        $localidades = Localidad::all();
        return view('admin.usuario.editarUsuario', compact('usuario', 'localidades'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Usuario  $usuario
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Usuario $usuario)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Usuario  $usuario
     * @return \Illuminate\Http\Response
     */
    public function destroy(Usuario $usuario)
    {
        //
        $usuario->getRoles()->detach();
        $usuario->getPermisos()->detach();
        $usuario->delete();
        return redirect(route('usuario.index'));
    }

    public function usuarioRolesyPermisos(Usuario $usuario, Request $request)
    {

        if ($request->ajax()) {
            $rol = Role::where('id_rol', $request->rol_id)->first();
            $permisos = $rol->getPermisos;
            $permisos[0]['check'] =  " ";
            foreach ($permisos as $permRol) {
                foreach ($usuario->getPermisos as $valor) {
                    if ($valor->id_permiso == $permRol->id_permiso) {
                        $check = "checked";
                        $permisos[0]['check'] =  $check;
                    }
                }
            }
            return $permisos;
        }

        $roles = Role::all();

        if (isset($usuario->getRoles)) {
            $rolesUsuario = $usuario->getRoles()->first();
            //dd($roles);
            if (isset($rolesUsuario->getPermisos) && isset($usuario->getPermisos)) {
                $permisosRol = $rolesUsuario->getPermisos;
                $permisosUsuario = $usuario->getPermisos;


                return view('admin.usuario.asignarRolesyPermisos', compact('usuario', 'roles', 'rolesUsuario', 'permisosRol', 'permisosUsuario'));
            }

            return view('admin.usuario.asignarRolesyPermisos', compact('usuario', 'roles', 'rolesUsuario'));
        }
        return view('admin.usuario.asignarRolesyPermisos', compact('usuario', 'roles'));
    }


    public function almacenarRolesyPermisos(Request $request)
    {
        //dd($request);
        $usuario = Usuario::where('id_usuario', $request->usuario)->first();

        $usuario->getRoles()->detach();
        $usuario->getPermisos()->detach();

        if ($request->rol != null) {
            $usuario->getRoles()->attach($request->rol);
            $usuario->save();
        }

        if ($request->listadoPermisos != null) {
            foreach ($request->listadoPermisos as $permiso) {
                $usuario->getPermisos()->attach($permiso);
                $usuario->save();
            }
        }

        return redirect(route('usuario.rolpermisos', [$usuario->id_usuario]));
    }
}
