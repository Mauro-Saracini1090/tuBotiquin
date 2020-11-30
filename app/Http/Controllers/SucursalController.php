<?php

namespace App\Http\Controllers;

use App\Mail\MensajeContactoFarmaceutico;
use App\Mail\SolicitudHabilitacionSucursalMailable;
use App\Mail\solicitudSucursalAceptadaMailable;
use App\Mail\solicitudSucursalRechazadaMailable;
use App\Models\Sucursal;
use App\Models\Farmacia;
use App\Models\ObraSocial;
use App\models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\Rule;

class SucursalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        if (\auth()->user()->getRoles->contains('slug_rol', 'es-administrador')) {
            Gate::authorize('esAdmin');
            $sucursales = Sucursal::simplePaginate(2);
            return view('admin.sucursales.indexSucursal', compact('sucursales'));
        }
        $id_usuario = auth()->user()->id_usuario;
        $farmacias = Farmacia::where("id_usuario", "=", $id_usuario)->where("borrado_logico_farmacia", "=", "0")->get();
        $sucursales = Sucursal::where("borrado_logico_sucursal", "=", "0")->get();
        return view('farmaceutico.listadoSucursal', compact('farmacias', 'sucursales'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (\auth()->user()->getRoles->contains('slug_rol', 'es-administrador')) {
            Gate::authorize('esAdmin');
            $arrayFarmacias = Farmacia::where('habilitada', "=", "1")->where("borrado_logico_farmacia", "=", "0")->get();
            return view('admin.sucursales.crearSucursal', compact('arrayFarmacias'));
        }

        $id_usuario = auth()->user()->id_usuario;
        $arrayFarmacias = Farmacia::where('id_usuario', "=", $id_usuario)->where('habilitada', "=", "1")->where("borrado_logico_farmacia", "=", "0")->get();

        return view('farmaceutico.cargarSucursal', ['arrayFarmacias' => $arrayFarmacias]);
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
        //Valida los campos del formulario cargarSucursal.blade
        $request->validate(([
            'id_farmacia' => 'required',
            'descripcion_sucursal' => 'max:255',
            'cufe_sucursal' => 'required|unique:sucursal|max:255',
            'email_sucursal' => 'required|email|unique:sucursal|max:255',
            'telefono_sucursal' => 'required|max:11',
            'direccion_sucursal' => 'required|unique:sucursal|max:255',
        ]));

        // Crear una nueva instacia de Farmacia y la guarda en la DB
        $habilitada = 0; // FLAG deshabilitada por defecto
        $borrado_logico_sucursal = 0; // FLAG
        $sucursal = new Sucursal();
        $sucursal->id_farmacia = $request->id_farmacia;

        if ($request->descripcion_sucursal != NULL) {
            $sucursal->descripcion_sucursal = $request->descripcion_sucursal;
        }

        $sucursal->cufe_sucursal = $request->cufe_sucursal;
        $sucursal->email_sucursal = $request->email_sucursal;
        $sucursal->telefono_sucursal  = $request->telefono_sucursal;
        $sucursal->direccion_sucursal = $request->direccion_sucursal;
        $sucursal->habilitado = $habilitada;
        $sucursal->borrado_logico_sucursal = $borrado_logico_sucursal;
        $sucursal->sucursal_latitud = $request->lat;
        $sucursal->sucursal_longitud = $request->long;
        $sucursal->save();

        if (\auth()->user()->getRoles->contains('slug_rol', 'es-administrador')) {
            Gate::authorize('esAdmin');
            return redirect(route('sucursal.index'));
        }
        //buscar email administrador
        $emailAdministrador = DB::table('usuario')
            ->join('usuario_roles', 'usuario.id_usuario', '=', 'usuario_roles.usuario_id')
            ->join('roles', 'usuario_roles.rol_id', '=', 'roles.id_rol')
            ->where('roles.slug_rol', '=', 'es-administrador')
            ->select('email')
            ->get();
        Mail::to($emailAdministrador)->send(new SolicitudHabilitacionSucursalMailable);

        return redirect(route('farmacia.index'))->with('estado_create', 'Su Sucursal se registró correctamente y será evaluada a la brevedad por el Administrador para verificar los datos.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Sucursal  $sucursal
     * @return \Illuminate\Http\Response
     */
    public function show(Sucursal $sucursal)
    {
        //
        Gate::authorize('esAdmin');

        return view('admin.sucursales.informacionSucursal', compact('sucursal'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Sucursal  $sucursal
     * @return \Illuminate\Http\Response
     */
    public function edit(Sucursal $sucursal)
    {
        //
        if (\auth()->user()->getRoles->contains('slug_rol', 'es-administrador')) {
            Gate::authorize('esAdmin');
            return view('admin.sucursales.editarSucursal', compact('sucursal'));
        }

        return view('farmaceutico.editarSucursal', ['sucursal' => $sucursal]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Sucursal  $sucursal
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Sucursal $sucursal)
    {
        $request->validate(([
            //'id_farmacia' => 'required',
            'descripcion_sucursal' => 'max:255',
            'cufe_sucursal' =>  'required|max:255',
            'cufe_sucursal' =>   Rule::unique('sucursal', 'cufe_sucursal')->ignore($sucursal->id_sucursal, 'id_sucursal'),
            'email_sucursal' =>  Rule::unique('sucursal', 'email_sucursal')->ignore($sucursal->id_sucursal, 'id_sucursal'),
            'email_sucursal' => 'required|email|max:255',
            'telefono_sucursal' => 'required|numeric',
            'telefono_sucursal' => Rule::unique('sucursal', 'telefono_sucursal')->ignore($sucursal->id_sucursal, 'id_sucursal'),
            'direccion_sucursal' => 'required|max:255',
            'direccion_sucursal' => Rule::unique('sucursal', 'direccion_sucursal')->ignore($sucursal->id_sucursal, 'id_sucursal'),
        ]));

        $sucursal->id_sucursal = $sucursal->id_sucursal;
        $sucursal->id_farmacia = $sucursal->id_farmacia;
        //Campos que se pueden modificar
        $sucursal->descripcion_sucursal = $request->descripcion_sucursal;
        $sucursal->cufe_sucursal = $request->cufe_sucursal;
        $sucursal->email_sucursal = $request->email_sucursal;
        $sucursal->telefono_sucursal = $request->telefono_sucursal;
        $sucursal->direccion_sucursal = $request->direccion_sucursal;
        //campso que nose pueden modificar    
        $sucursal->habilitado = $sucursal->habilitado;
        $sucursal->borrado_logico_sucursal = $sucursal->borrado_logico_sucursal;
            
        if($request->lat != null && $request->long != null){
            $sucursal->sucursal_latitud = $request->lat;
            $sucursal->sucursal_longitud = $request->long;
        }
        $sucursal->sucursal_latitud = $sucursal->sucursal_latitud;
        $sucursal->sucursal_longitud = $sucursal->sucursal_longitud;

        $sucursal->save();

        if (\auth()->user()->getRoles->contains('slug_rol', 'es-administrador')) {
            Gate::authorize('esAdmin');
            return redirect(route('sucursal.index'));
        }

        return redirect(route('farmacia.index'))->with('estado_update', 'Los cambios se registraron correctamente en la plataforma.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Sucursal  $sucursal
     * @return \Illuminate\Http\Response
     */
    public function destroy(Sucursal $sucursal)
    {

        $sucursal->borrado_logico_sucursal = 1;
        $sucursal->save();

        return redirect(route('farmacia.index'))->with('estado_delete', 'Su Sucursal se ha borrado correctamente de la plataforma.  Contacte al Adminstardor para mas información');
    }
    public function borrarSucursal(Sucursal $sucursal)
    {
        $sucursal->delete();
        return redirect(route('sucursal.index'))->with('estado_delete', 'La Sucursal se ha borrado correctamente de la plataforma.');
    }

    public function buscarFarmaciaSucursal(Request $request)
    {

        //$farmacia = Farmacia::where("id_farmacia", "=" , $request->id_farmacia)->get();
        $farmacia = Farmacia::find($request->id_farmacia);
        $arraySucursales = Sucursal::where("id_farmacia", "=" , $request->id_farmacia)->get();
        $arrayObraSociales = $farmacia->obrasSociales;
        return view('publico.verFarmaciaySucursal' , [
                    'arraySucursales' => $arraySucursales,
                    'farmacia' => $farmacia,
                    'arrayObraSociales' => $arrayObraSociales,
        ]);
    }


    /**
     * 
     */
    public function farmaciaSucursal(Request $request)
    {

        $farmacia = $request->id_farmacia;
        $farmacia = Farmacia::find($farmacia);
        $arraySucursales = Sucursal::where("id_farmacia", "=", $farmacia->id_farmacia)->where("borrado_logico_sucursal", "=", "0")->get();

        $arrayObraSociales = $farmacia->obrasSociales;

        return view('publico.verFarmaciaySucursal', [
            'arraySucursales' => $arraySucursales,
            'farmacia' => $farmacia,
            'arrayObraSociales' => $arrayObraSociales,
        ]);
    }

    public function solicitudSucursal(Request $request)
    {
        Gate::authorize('esAdmin');
        $sucursal = Sucursal::find($request->sucursal);
        $borado_logico = 1;
        if($request->estado_habilitacion == 0)
        {   
            $sucursal->borrado_logico_sucursal=$borado_logico;
            $sucursal->habilitado = $request->estado_habilitacion;
            $sucursal->save();
            Mail::to($sucursal->getFarmacia->usuarioFarmaceutico->email)->send(new solicitudSucursalRechazadaMailable);

        }else{
            $sucursal->habilitado = $request->estado_habilitacion;
            $sucursal->save();
            Mail::to($sucursal->getFarmacia->usuarioFarmaceutico->email)->send(new solicitudSucursalAceptadaMailable);

        }
        return redirect(route('sucursal.show', [$sucursal->id_sucursal]));
    }

    /**
     * Funcion que retorna un formulario de vista.
     * Pertenece al user Farmaceutico y lo recibe el admin en su correo
     */    
    public function contactarAdmin()
    {
        $id_usuario = auth()->user()->id_usuario;
        $usuarioFarmaceutico = Usuario::find($id_usuario);
        return view('farmaceutico.contactarAdmin', ['usuario' => $usuarioFarmaceutico]);
    }

    /**
     * Funcion que recibe los datos del formulario de contactar al Administrador
     * y envia por mail al admin
     */
    public function enviarEmailAdministrador(Request $request)
    {
        //Valida los campos del formulario de contactar al Administrador
        $request->validate([
            'email' => 'required|email|max:255',
            'radio' =>'required',
            'consulta' => 'required|max:3000',
         ]);

         $variablesContacto = $request;
         // Si la validacion es correcta se procede a enviar el mail al administrador de Tubotiquín
         Mail::to('tubotiquin2020@gmail.com')->send(new MensajeContactoFarmaceutico($variablesContacto));

        return redirect(route('farmacia.index'))->with('mensajeEnviado', 'Su mensaje fue enviado con exito, a la brevedad le estaremos respondiendo. Gracias por su consulta');

    }
}
