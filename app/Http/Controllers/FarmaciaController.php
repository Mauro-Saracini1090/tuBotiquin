<?php

namespace App\Http\Controllers;

use App\Mail\solicitudFarmaciaAceptadaMailable;
use App\Mail\solicitudFarmaciaRechazadaMailable;
use App\Mail\SolicitudHabilitacionFarmaciaMailable;
use App\Models\Farmacia;
use APP\Models\Sucursal;
use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use League\CommonMark\Inline\Element\Strong;

class FarmaciaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (\auth()->user()->getRoles->contains('slug_rol', 'es-administrador')) {
            Gate::authorize('esAdmin');
            $arrayFarmacias = Farmacia::simplePaginate(2);
            return view('admin.farmacias.indexFarmacias', compact('arrayFarmacias'));
        }
        return view('farmaceutico.indexFarmaceutico');
    }


    public function verFarmacia()
    {
        $id_usuario = auth()->user()->id_usuario;
        $arrayFarmacias = array();
        $arrayFarmacias = Farmacia::where("id_usuario", "=", $id_usuario)->where("borrado_logico_farmacia", "=", "0")->get();
        //dd($arrayFarmacias);

        if (!(count($arrayFarmacias) >= 0)) {
            $arrayFarmacias = null;
        }
        return view('farmaceutico.verFarmacia', ['arrayFarmacias' => $arrayFarmacias]);
    }

    public function listarFarmacias(Request $request)
    {
        //Se obtienen todas las farmacias en estado habilitado = 1
        //Se paginan de a 6 elementos para ser mostrados en la vista

        $nombreFarmacia = $request->get('busquedafarmacia');

        $farmaciasPaginate = Farmacia::where("habilitada", "=", "1")->where("borrado_logico_farmacia", "=", "0")->NombreFarmacia($nombreFarmacia)->simplePaginate(6);
        $arrayFarmacias = Farmacia::where("habilitada", "=", "1")->where("borrado_logico_farmacia", "=", "0")->get();

        return view('publico.farmacias', [
            'arrayFarmaciasPaginate' => $farmaciasPaginate,
        ]);
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
            $farmaceuticos = DB::table('usuario')->whereNotNull('numero_matricula')->get();
            return view('admin.farmacias.crearFarmacia', compact('farmaceuticos'));
        }

        // Retorna a la vista para cargar una nueva Farmacia a traves de  un formulario
        //return view('farmaceutico.cargarFarmacia');
        return view('farmaceutico.cargarFarmacia');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //Valida los campos del formulario cargarFarmacia.blade
        $request->validate(([
            'nombre_farmacia' => 'required|max:255|unique:farmacia',
            'descripcion_farmacia' => 'max:250',
            'cuit' => 'required|unique:farmacia|max:255',
            'img_farmacia' => 'required|image|mimes:jpeg,jpe,png|max:4096',
            'cuit' => 'required|between:8,20',
        ]));

        // Crear una nueva instacia de Farmacia y la guarda en la DB
        $habilitada = 0; // FLAG deshabilitada por defecto
        $borado_logico = 0; // FALG - False por defecto, se cambia a verdadero por el admin
        $id_usuario = auth()->user()->id_usuario;

        $farmacia = new Farmacia();
        $farmacia->id_usuario = $id_usuario;
        $farmacia->nombre_farmacia = $request->nombre_farmacia;

        $img_logo = $request->file('img_farmacia')->store('public/img_farmacias');
        $img_farmacia = Storage::url($img_logo);

        $farmacia->img_farmacia = $img_farmacia;

        if ($request->descripcion_farmacia != null) {
            $farmacia->descripcion_farmacia = $request->descripcion_farmacia;
        } else {
            $farmacia->descripcion_farmacia = NULL;
        }

        $farmacia->cuit = $request->cuit;
        $farmacia->habilitada = $habilitada;
        $farmacia->borrado_logico_farmacia = $borado_logico;
        $farmacia->save();

        //Se busca el email del usuario administrador
        // $emailAdministrador = DB::table('usuario')
        // ->join('usuario_roles', 'usuario.id_usuario', '=', 'usuario_roles.usuario_id')
        // ->join('roles', 'usuario_roles.rol_id', '=', 'roles.id_rol')
        // ->where('roles.slug_rol', '=', 'es-administrador')
        // ->select('email')
        // ->get();
        // Mail::to($emailAdministrador)->send(new SolicitudHabilitacionFarmaciaMailable);


        return redirect(route('farmacia.index'))->with('estado_create', 'Su Farmacia se registró correctamente y será evaluada a la brevedad por el Administrador para verificar los datos.');
    }
    public function almacenarFarmaciasAdmin(Request $request)
    {
        //Valida los campos 
        Gate::authorize('esAdmin');

        Request()->validate(([
            'nombre_farmacia' => 'required',
            // 'farmaceutico' => 'required',
            'img_farmacia' => 'required|image|mimes:jpeg,png|max:4096',
            'cuit' => 'required|unique:farmacia|max:255',
            'habilitada' => 'required',
        ]));

        // Crear una nueva instacia de Farmacia y la guarda en la DB
        // FLAG deshabilitada por defecto
        $borado_logico = 0; // FALG - False por defecto, se cambia a verdadero por el admin

        $farmacia = new Farmacia();
        $farmacia->id_usuario = auth()->user()->id_usuario;
        $farmacia->nombre_farmacia = strtoupper($request->nombre_farmacia);

        if ($request->img_farmacia != null) {
            $img_logo = $request->file('img_farmacia')->store('public/img_farmacias');
            $img_farmacia = Storage::url($img_logo);
            $farmacia->img_farmacia = $img_farmacia;
        } else {
            $farmacia->img_farmacia = '';
        }

        $farmacia->descripcion_farmacia = $request->descripcion_farmacia;
        $farmacia->cuit = $request->cuit;
        $farmacia->habilitada = $request->habilitada;
        $farmacia->borrado_logico_farmacia = $borado_logico;
        $farmacia->save();


        return redirect(route('farmacia.index'))->with('estado_create', 'Su Farmacia se registró correctamente y será evaluada a la brevedad por el Administrador para verificar los datos.');
    }

    //public function farmaciabuscar($nombreFarmacia)
    //{

    //    $farmaciaEncontrada = Farmacia::where("nombre", "=", $nombreFarmacia);
    //    return view('farmacia.farmacias', ['farmaciaEncontradas' => $farmaciaEncontrada]);

    //}

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Farmacia  $farmacia
     * @return \Illuminate\Http\Response
     */
    public function show(Farmacia $farmacium)
    {
        //            
        Gate::authorize('esAdmin');


        return view('admin.farmacias.informacionFarmacia', compact('farmacium'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Farmacia  $farmacia
     * @return \Illuminate\Http\Response
     */
    public function edit(Farmacia $farmacium)
    {
        $farmacia = $farmacium;
        if (\auth()->user()->getRoles->contains('slug_rol', 'es-administrador')) {
            Gate::authorize('esAdmin');

            return view('admin.farmacias.editarFarmacia', compact('farmacia'));
        }


        return view('farmaceutico.editarFarmacia', compact('farmacia'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Farmacia  $farmacia
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Farmacia $farmacium)
    {
        $farmacia = $farmacium;

        //Valida los campos del formulario editarFarmacia.blade 
        $request->validate(([
            'nombre_farmacia' => 'required|max:255|unique:farmacia',
            'descripcion_farmacia' => 'max:250',
            'img_farmacia' => 'image|mimes:jpeg,jpe,png|max:4096',
            'cuit' => 'required|between:8,20',
        ]));


        if ($request->descripcion_farmacia != null) {
            $farmacia->descripcion_farmacia = $request->descripcion_farmacia;
        }
        if ($request->img_farmacia != null) {
            $img_logo = $request->file('img_farmacia')->store('public/img_farmacias');
            $img_farmacia = Storage::url($img_logo);
            $farmacia->img_farmacia = $img_farmacia;
        }
        $farmacia->id_usuario = $farmacia->id_usuario;
        $farmacia->img_farmacia = $farmacia->img_farmacia;
        $farmacia->nombre_farmacia = strtoupper($request->nombre_farmacia);
        $farmacia->cuit = $request->cuit;
        $farmacia->habilitada = $farmacia->habilitada;
        $farmacia->save();

        return redirect(route('farmacia.index'))->with('estado_update', 'Los cambios se registraron correctamente en la plataforma.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Farmacia  $farmacia
     * @return \Illuminate\Http\Response
     */
    public function destroy(Farmacia $farmacium)
    {
        $farmacia = $farmacium;
        $farmacia->borrado_logico_farmacia = 1;
        $farmacia->save();

        return redirect(route('farmacia.index'))->with('estado_delete', 'Su Farmacia se ha borrado correctamente de la plataforma.  Contacte al Adminstardor para mas información');
    }

    public function borrarFarmacias(Farmacia $farmacia)
    {
        Gate::authorize('esAdmin');

        $farmacia->delete();
        return redirect(route('farmacia.index'))->with('estado_delete', 'Su Farmacia se ha borrado correctamente de la plataforma.  Contacte al Adminstardor para mas información');
    }

    // public function solicitudFarmacia(Request $request)
    // {
    //     Gate::authorize('esAdmin');
    //     $farmacia = Farmacia::find($request->farmacia);
    //     $borado_logico = 1;
    //     if($request->estado_habilitacion == 0)
    //     {   
    //         $farmacia->borrado_logico_farmacia=$borado_logico;
    //         $farmacia->habilitada = $request->estado_habilitacion;
    //         $farmacia->save();
    //         Mail::to($farmacia->usuarioFarmaceutico->email)->send(new solicitudFarmaciaRechazadaMailable);

    //     }else{
    //         $farmacia->habilitada = $request->estado_habilitacion;
    //         $farmacia->save();
    //         Mail::to($farmacia->usuarioFarmaceutico->email)->send(new solicitudFarmaciaAceptadaMailable($farmacia) );

    //     }


    //     return redirect(route('farmacia.show', [$farmacia->id_farmacia]));
    // }
}
