<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use App\Http\Controllers\Controller;
use App\Models\Localidad;
use Illuminate\Http\Request;

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
        $usuarios = Usuario::all();
        return view('admin.usuario.listaUsuarios',compact('usuarios'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $localidades = Localidad::all();
        return view('admin.usuario.crearUsuario',compact('localidades'));
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
        return view('admin.usuario.verUsuario',compact('usuario'));
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
        return view('admin.usuario.editarUsuario',compact('usuario','localidades'));
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
        $usuario->delete();
        return redirect(route('usuario.index'));
    }
}
