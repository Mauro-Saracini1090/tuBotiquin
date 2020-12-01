<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use App\Http\Controllers\Controller;
use App\Mail\SolicitudUsuarioAceptadaMailable;
use App\Mail\SolicitudUsuarioRechazadaMailable;
use App\Models\Localidad;
use App\Models\Role;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

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
        //Valida los campos del formulario registro
        $request->validate([
            'nombre' => 'required|max:255',
            'apellido' => 'required|max:255',
            'nombre_usuario' => 'required|unique:usuario|max:255',
            'email' => 'required|unique:usuario|email|max:255',
            'password' => 'required|max:255|between:8,50',
            'cod_postal' => 'required|numeric',
            'cuil' => 'required|unique:usuario|numeric|between:8,20',
            'cuit' => 'required|unique:usuario|numeric|between:8,20',
            'dni' => 'required|unique:usuario|numeric|between:7,8',
            'matricula' => 'required|unique:usuario|max:200',
        ]);

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
        $usuario->password = Hash::make($request->password);
        $usuario->cod_postal = $request->localidad;
        $usuario->cuil = $request->cuil;
        $usuario->cuit = $request->cuit;
        $usuario->dni = $request->dni;
        $usuario->numero_matricula = $request->matricula;
        $usuario->img_perfil = NULL;
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
        //dd($request);
        if ($request->habilitado == 'si') {
            $habilitado = true;
        } else {
            $habilitado = false;
        }

        $usuario->nombre = $request->nombre;
        $usuario->apellido = $request->apellido;
        $usuario->nombre_usuario = $request->nombreUsuario;
        $usuario->email = $request->email;
        $usuario->password = $usuario->password;
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



    /**
     * Funcion que muestra el perfil con lso datos del usuario farmaceutico
     */
    public function verMiPerfilFarmaceutico()
    {

        $id_usuarioFarma = auth()->user()->id_usuario;
        $usuarioFarmaceutico = Usuario::find($id_usuarioFarma);
        return view('farmaceutico.miPerfilFarmaceutico', ["usuarioFarmaceutico" => $usuarioFarmaceutico]);
    }


    /**
     * 
     */
    public function subirFotoPerfil()
    {
        $id_usuarioFarma = auth()->user()->id_usuario;
        $usuarioFarmaceutico = Usuario::find($id_usuarioFarma);
        return view('farmaceutico.cargarFotoPerfil', ["usuarioFarmaceutico" => $usuarioFarmaceutico]);
        //return view ('farmaceutico.cargarFotoPerfil');
    }


    public function cargarFotoPerfil(Request $request)
    {

        $id_usuarioFarma = auth()->user()->id_usuario;
        $usuarioFarmaceutico = Usuario::find($id_usuarioFarma)->first();
        $request->validate([
            'img_ferfil_form' => 'required|image|mimes:jpeg,jpe,png|max:4096',
        ]);

        $img_perfil_form = $request->file('img_ferfil_form')->store('public/foto_perfil');
        $img_perfil = Storage::url($img_perfil_form);
        $usuarioFarmaceutico->img_perfil = $img_perfil;
        $usuarioFarmaceutico->save();
        return view('farmaceutico.miPerfilFarmaceutico', ["usuarioFarmaceutico" => $usuarioFarmaceutico]);
    }

    public function editarPerfil()
    {

        $id_usuarioFarma = auth()->user()->id_usuario;
        $usuarioFarmaceutico = Usuario::find($id_usuarioFarma);
        $localidades = Localidad::all();
        return view('farmaceutico.editarPerfil', [
            'localidades' => $localidades,
            'usuario' => $usuarioFarmaceutico,
        ]);
    }


    /**
     * 
     * REVISAR ESTO NO ANDA BIEN ____ :T
     */
    public function actualizarPerfil(Usuario $usuario, Request $request)
    {
        //Valida los campos del formulario registro
        $request->validate([
            //'id_farmacia' => 'required',
            'nombre' => ['required', 'string', 'max:255'],
            'apellido' => ['required', 'string', 'max:255'],
            'localidad' => ['required'],
            'nombre_usuario' => ['required', Rule::unique('usuario', 'nombre_usuario')->ignore($usuario->id_usuario, 'id_usuario')],
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('usuario', 'email')->ignore($usuario->id_usuario, 'id_usuario')],
            'telefono_movil' => ['required', 'integer', 'digits_between:8,12', Rule::unique('usuario', 'telefono_movil')->ignore($usuario->id_usuario, 'id_usuario')],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'cuil' => ['required', 'string', 'min:8', Rule::unique('usuario', 'cuil')->ignore($usuario->id_usuario, 'id_usuario')],
            'cuit' => ['required', 'string', 'min:8', Rule::unique('usuario', 'cuit')->ignore($usuario->id_usuario, 'id_usuario')],
            'numero_matricula' => ['required', 'string', 'min:8', Rule::unique('usuario', 'numero_matricula')->ignore($usuario->id_usuario, 'id_usuario')],
            'img_perfil' => ['string max:255'],
            'dni' => ['required', 'string', 'min:8', Rule::unique('usuario','dni')->ignore($usuario->id_usuario, 'id_usuario')],
        ]);

        $usuario->nombre = $request->nombre;
        $usuario->apellido = $request->apellido;
        $usuario->nombre_usuario = $request->nombre_usuario;
        $usuario->email = $request->email;
        $usuario->password = Hash::make($request->password);
        $usuario->cod_postal = $request->localidad;
        $usuario->telefono_movil = $request->telefono_movil;
        $usuario->cuil = $request->cuil;
        $usuario->cuit = $request->cuit;
        $usuario->dni = $request->dni;
        $usuario->numero_matricula = $request->matricula;
        $usuario->habilitado = "1";

        if ($usuario->img_perfil  == NULL) {
            $usuario->img_perfil = NULL;
        } else {
            $usuario->img_perfil = $usuario->img_perfil;
        }

        $usuario->save();
        return view('farmaceutico.miPerfilFarmaceutico', [ "usuarioFarmaceutico" => $usuario ]); 

    }

    public function solicitudUsuario(Request $request)
    {
        Gate::authorize('esAdmin');
        $usuario = Usuario::find($request->usuario);
        if ($request->estado_habilitacion == 0) {
            $usuario->habilitado = $request->estado_habilitacion;
            $usuario->save();
            Mail::to($usuario->email)->send(new SolicitudUsuarioRechazadaMailable);
        } else {
            $usuario->habilitado = $request->estado_habilitacion;
            $usuario->save();
            Mail::to($usuario->email)->send(new SolicitudUsuarioAceptadaMailable);
        }
        return redirect(route('usuario.show', [$usuario->id_usuario]));
    }
}
