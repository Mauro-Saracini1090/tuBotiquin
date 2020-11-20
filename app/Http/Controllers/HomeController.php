<?php

namespace App\Http\Controllers;

use App\Models\Turno;
use DateInterval;
use DatePeriod;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Date;

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
        $hoy = date('Y-m-d');
        // dd($hoy); 
        $turnos = Turno::where('fecha_turno', '=', $hoy)->first();

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
        $TurnoSiguientes=  Turno::where('fecha_turno', '=', $fechasSiguiente1)->orWhere('fecha_turno', '=', $fechasSiguiente2)->orWhere('fecha_turno', '=', $fechasSiguiente3)->get();
        $arrSucursalesTurnoSiguiente = array();
       
            foreach ($TurnoSiguientes as $turno) {
                // array_push($arrSucursalesTurnoSiguiente = $turno->getSucursales->take(3));
                foreach ($turno->getSucursales->take(2) as $sucursal) {
                   array_push($arrSucursalesTurnoSiguiente,$sucursal);
                }
            }
        
        
        //dd($arrSucursalesTurnoSiguiente);
        return view('layout.contenidoPrincipal', compact('sucursalesTurno','arrSucursalesTurnoSiguiente'));
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function farmaciasTurnoHoy()
    {
    }

    public function farmaciasTurnoProximas()
    {
    }
}
