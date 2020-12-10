<?php

namespace App\Http\Controllers;

use App\Mail\reservaAceptadaMailable;
use App\Mail\reservaRechazadaMailable;
use App\Models\Estados;
use App\Models\Reserva;
use App\Models\Sucursal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Mail;

class ReservaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Reserva  $reserva
     * @return \Illuminate\Http\Response
     */
    public function show(Reserva $reserva)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Reserva  $reserva
     * @return \Illuminate\Http\Response
     */
    public function edit(Reserva $reserva)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Reserva  $reserva
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Reserva $reserva)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Reserva  $reserva
     * @return \Illuminate\Http\Response
     */
    public function destroy(Reserva $reserva)
    {
        //
    }
    
    public function autocompleteporfarmacia(Request $request)
    {
        //
        if ($request->has('term')) {
            $arrfarmacia = [];
            $sucursales = Sucursal::where('usuario_id', '=', \auth()->user()->id_usuario)->where('habilitado', '=', 1)->where('borrado_logico_sucursal', '=', 0)->get();
            foreach ($sucursales as $sucursal) {
                $farmacia = $sucursal->getFarmacia;
                if (count($arrfarmacia) > 0) {
                    foreach ($arrfarmacia as $unidad) {
                        # code...
                        if ($unidad->id_farmacia != $farmacia->id_farmacia) {
                            array_push($arrfarmacia, $farmacia);
                        }
                    }
                } else {
                    array_push($arrfarmacia, $farmacia);
                }
            }
            return $arrfarmacia;
            // return Farmacia::where('nombre_farmacia', 'like', $request->input('term') . '%')->get();
        }
    }

    public function solicitudReserva(Request $request)
    {
        // dd($request);
        Gate::authorize('esFarmaceutico');
        $reserva = Reserva::find($request->reserva);
        if($request->estado_habilitacion == 3)
        {   
            $reserva->estados_id = $request->estado_habilitacion;
            $reserva->save();
            Mail::to($reserva->reservaUsuario->email)->send(new reservaAceptadaMailable);
            $mensaje = "La Reserva fue Aceptada con correctamento.";
        }        
        if($request->estado_habilitacion == 2)
        {   
            $reserva->estados_id = $request->estado_habilitacion;
            $reserva->save();
            Mail::to($reserva->reservaUsuario->email)->send(new reservaRechazadaMailable);
            $sucursalActual = $reserva->getSucursal;
            $farmacia = $sucursalActual->getFarmacia;
            foreach ($reserva->reservaMedicamentos as $medicamentos){
                $cantidadReserva = $medicamentos->pivot->cantidad;
                // dd($farmacia->getSucursales);
                foreach($farmacia->getSucursales as $sucursal){
                    $med = $sucursal->getMedicamentos()->where('medicamento_id','=',$medicamentos->id_medicamento)->first();
                    // $medReserva = $reserva->getMedicamentos()->where('medicamento_id','=',$medicamentos->id_medicamento)->first();
                    $cantidadTotal = $med->pivot->cantidadTotal;
                    $sucursal->getMedicamentos()->updateExistingPivot($medicamentos->id_medicamento ,['cantidadTotal' => ($cantidadTotal + $cantidadReserva)]);
                }
            }
            $mensaje = "La Reserva fue rechazada con correctamento."; 
        }
        


        return redirect(route('listado.reservas.farmaceutico'))->with('solicitudReserva',$mensaje);
   
    }

}
