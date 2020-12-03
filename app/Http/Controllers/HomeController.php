<?php

namespace App\Http\Controllers;

use App\Models\Farmacia;
use App\Models\Sucursal;
use App\Models\Turno;
use App\Models\ObraSocial;
use DateInterval;
use DatePeriod;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\Mail;
use App\Mail\MensajeContacto;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        // 
        // if (\auth()->user()->getRoles->contains('slug_rol','es-administrador')) {
        //     Gate::authorize('esAdmin');
        //     return redirect('/administrador');
        // }
        $hoy = date('Y-m-d');
        // dd($hoy); 
        $turnos = Turno::where('fecha_turno', '=', $hoy)->first();
        $sucursalesTurno = [];
        $arrSucursalesTurnoSiguiente = [];
        if (isset($turnos)) {


            $sucursalesTurno = $turnos->getSucursales->take(2);

            //Primera Forma Para obtener Dias siguientes
            //La clase DatePeriod 
            // (PHP 5 >= 5.3.0, PHP 7)
            // Representa un período de fechas.
            // Un período de fechas permite la iteración sobre un conjunto de fechas y horas, repitiéndose a intervalos regulares durante un período dado.
            // dd($sucursalesTurno);
            // $periodo = new DatePeriod(new DateTime(), new DateInterval('P1D'), 3);
            // $fechasSiguientes = array();
            // foreach ($periodo as $date) {
            //     array_push($fechasSiguientes, $date->format('Y-m-d'));
            // }
            // Segunda Forma, Mas simple pero efectiva
            $fechasSiguiente1 = date('Y-m-d', strtotime('+1 days'));
            $fechasSiguiente2 = date('Y-m-d', strtotime('+2 days'));
            $fechasSiguiente3 = date('Y-m-d', strtotime('+3 days'));
            $TurnoSiguientes =  Turno::where('fecha_turno', '=', $fechasSiguiente1)->orWhere('fecha_turno', '=', $fechasSiguiente2)->orWhere('fecha_turno', '=', $fechasSiguiente3)->get();
            $arrSucursalesTurnoSiguiente = array();

            foreach ($TurnoSiguientes as $turno) {
                // array_push($arrSucursalesTurnoSiguiente = $turno->getSucursales->take(3));
                if (count($arrSucursalesTurnoSiguiente) < 3) {
                    foreach ($turno->getSucursales->take(2) as $sucursal) {
                        array_push($arrSucursalesTurnoSiguiente, $sucursal);
                    }
                }
            }
        }
        //dd($arrSucursalesTurnoSiguiente);
        return view('publico.contenidoPrincipal', compact('sucursalesTurno', 'arrSucursalesTurnoSiguiente'));
    }

    /**
     * Funcion que invoca el formulario de contacto del menu del home 
     */
    public function emailContacto()
    {
        return view('publico.emailContacto');
    }

    /**
     * Funcion que recibe por post los datos del formulario de contacto
     */
    public function enviarEmailContacto(Request $request)
    {
        //Valida los campos del formulario de contacto
        $request->validate([
            'nombre' => 'required|max:255',
            'email' => 'required|email|max:255',
            'asunto' => 'required|max:255',
            'consulta' => 'required|max:600',
        ]);

        $variablesContacto = $request;
        // Si la validacion es se procede a enviar el mail al administrador de Tubotiquín
        $emailAdministrador = DB::table('usuario')
            ->join('usuario_roles', 'usuario.id_usuario', '=', 'usuario_roles.usuario_id')
            ->join('roles', 'usuario_roles.rol_id', '=', 'roles.id_rol')
            ->where('roles.slug_rol', '=', 'es-administrador')
            ->select('email')
            ->get();
        Mail::to($emailAdministrador)->send(new MensajeContacto($variablesContacto));

        return redirect(route('home'))->with('mensajeEnviado', 'Su mensaje fue enviado con exito, a la brevedad le estaremos respondiendo. Gracias por su consulta');
    }

    /**
     * Funcion que lista los datos de la farmacia y sucursal (solo una) de turno del home. 
     * Se llama en el boton "ver sucursal" de los cards
     */
    public function verSucursalTurnoHoy(Request $request)
    {
        $sucursal = Sucursal::find($request->id_sucursal);
        $farmacia = Farmacia::find($sucursal->id_farmacia);
        $arrayObraSociales = $farmacia->obrasSociales;

        return view('publico.verSucursalTurnoHoy', [
            'sucursal' => $sucursal,
            'farmacia' => $farmacia,
            'arrayObraSociales' => $arrayObraSociales,
        ]);
    }


    /**
     * Funcion que lista todas las farmacias cargdas de turno.
     * Se llama en el boton del home [ Ver mas ]
     */
    public function verSucursalesProximasTurno()
    {
        //$arrayTurnos = Turno::all();
        $fechasSiguiente1 = date('Y-m-d', strtotime('+1 days'));
        $fechasSiguiente2 = date('Y-m-d', strtotime('+2 days'));
        $fechasSiguiente3 = date('Y-m-d', strtotime('+3 days'));
        $fechasSiguiente4 = date('Y-m-d', strtotime('+4 days'));
        $fechasSiguiente5 = date('Y-m-d', strtotime('+5 days'));
        $fechasSiguiente6 = date('Y-m-d', strtotime('+6 days'));
        $arrayTurnos =  Turno::where('fecha_turno', '=', $fechasSiguiente1)->orWhere('fecha_turno', '=', $fechasSiguiente2)
            ->orWhere('fecha_turno', '=', $fechasSiguiente3)->orWhere('fecha_turno', '=', $fechasSiguiente4)
            ->orWhere('fecha_turno', '=', $fechasSiguiente5)->orWhere('fecha_turno', '=', $fechasSiguiente6)->get();
        $arrSucursalDia = array();
        $arrSucursalDiaCompleto = array();

        foreach ($arrayTurnos as  $turno) {
            foreach ($turno->getSucursales as $sucursal) {
                $originalDate = $turno->fecha_turno;
                $newDate = date("d/m/Y", strtotime($originalDate));
                $arrSucursalDia = ["sucursal" => $sucursal, "diaTurno" => $newDate];
                array_push($arrSucursalDiaCompleto, $arrSucursalDia);
            }
        }
        return view('publico.verSucursalProximosDias', ['arregloSucursalTurnodia' => $arrSucursalDiaCompleto]);
    }
}
