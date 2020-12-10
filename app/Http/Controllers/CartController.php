<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Mail\reservaRealizadaMailable;
use App\Models\Farmacia;
use App\Models\Medicamento;
use App\Models\Reserva;
use App\Models\Sucursal;
use Darryldecode\Cart\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class CartController extends Controller
{
    //
    public function add(Request $request)
    {
        // dd($request);
        $farmacia = Farmacia::where('id_farmacia', '=', $request->farmacia_id)->first();
        $sucursal = $farmacia->getSucursales;
        // dd($sucursal);

        foreach ($farmacia->getSucursales as $sucursal) {
            if ((DB::table('sucursal_medicamento')->where('medicamento_id', '=', $request->producto_id)->where('sucursal_id', '=', $sucursal->id_sucursal)->first()) != []) {
                $med = $sucursal->getMedicamentos()->where('medicamento_id', '=', $request->producto_id)->first();
                // $medReserva = $reserva->getMedicamentos()->where('medicamento_id','=',$medicamentos->id_medicamento)->first();
                $cantidadTotal = $med->pivot->cantidadTotal;
                $sucursal->getMedicamentos()->updateExistingPivot($request->producto_id, ['cantidadTotal' => ($cantidadTotal - $request->cantidad)]);
                $cantidadT = ($cantidadTotal - $request->cantidad);
            }
        }

        $producto = Medicamento::where('id_medicamento', '=', $request->producto_id)->first();

        \Cart::add(
            $producto->id_medicamento,
            $producto->nombre_medicamento,
            null,
            $request->cantidad,
            $farmacia->id_farmacia,
            $sucursal,
            $cantidadT,
        );

        return back()->with('success', "$producto->nombre ¡se ha agregado con éxito al carrito!");
    }

    public function cart()
    {
        $farmacia = [];
        $sucursal = [];
        foreach (\Cart::getContent() as $item) {
            // $item->id;
            // $item->name;
            // $item->quantity;
            $farmacia = Farmacia::where('id_farmacia', '=', $item->farmacia)->first();

        }

        return view('registrado.cart.checkout', compact('farmacia'));
    }

    public function removeitem(Request $request)
    {
        //$producto = Producto::where('id', $request->id)->firstOrFail();
        // dd($request);
        $farmacia = json_decode($request->farmacia);
        $farmacia = Farmacia::where('id_farmacia','=',$farmacia->id_farmacia)->first();
        // dd($farmacia);
        foreach ($farmacia->getSucursales as $sucursal) {
            if ((DB::table('sucursal_medicamento')->where('medicamento_id', '=', $request->id)->where('sucursal_id', '=', $sucursal->id_sucursal)->first()) != []) {
                $med = $sucursal->getMedicamentos()->where('medicamento_id', '=', $request->id)->first();
                // $medReserva = $reserva->getMedicamentos()->where('medicamento_id','=',$medicamentos->id_medicamento)->first();
                $cantidadTotal = $med->pivot->cantidadTotal;
                $sucursal->getMedicamentos()->updateExistingPivot($request->id, ['cantidadTotal' => ($cantidadTotal + $request->total)]);
            }
        }
        \Cart::remove([
            'id' => $request->id,
        ]);



        // foreach ($farmacia->getSucursales as $sucursal) {
        //     if ((DB::table('sucursal_medicamento')->where('medicamento_id', '=', $producto->producto_id)->where('sucursal_id', '=', $sucursal->id_sucursal)->first()) != []) {
        //         $med = $sucursal->getMedicamentos()->where('medicamento_id', '=', $producto->producto_id)->first();
        //         // $medReserva = $reserva->getMedicamentos()->where('medicamento_id','=',$medicamentos->id_medicamento)->first();
        //         $cantidadTotal = $med->pivot->cantidadTotal;
        //         $sucursal->getMedicamentos()->updateExistingPivot($producto->producto_id, ['cantidadTotal' => ($cantidadTotal + $request->cantidad)]);
        //     }
        // }

        return back()->with('borrado', "Producto eliminado con éxito de su carrito.");
    }

    public  function clear()
    {
       
        \Cart::clear();
        return back()->with('clear', "Su carrito de reservas a sido reseteado, recuerde que solo puede reservar en una farmacia a la vez.");
    }

    public function confirmarReserva(Request $request)
    {
        // dd($request);
        $sucursal = Sucursal::where('id_sucursal', '=', $request->id_sucursal)->first();
        $farmacia = $sucursal->getFarmacia;
        $arrSucursal = $farmacia->getSucursales;
        // dd($farmacia->getSucursales);

        foreach ($request->medicamentos as $unidadMed) {
            // dd(count($farmacia->getSucursales));
            foreach ($arrSucursal as $uniSucursal) {
                // dd($arrSucursal);
                if ((DB::table('sucursal_medicamento')->where('medicamento_id', '=', $unidadMed)->where('sucursal_id', '=', $uniSucursal->id_sucursal)->first()) != []) {
                    $med = $uniSucursal->getMedicamentos()->where('medicamento_id', '=', $unidadMed)->first();
                    // dd($med->pivot->cantidadTotal);
                    // dd($request->cantidad[$unidadMed]);
                    $cantidadTotal = $med->pivot->cantidadTotal;
                    if ($cantidadTotal < $request->cantidad[$unidadMed]) {
                        return redirect(route('cart.checkout'))->with('overflow', 'Alguno de los items ingresados supera lo que hay el Stock Total Disponible, Verifique y Elimine el item del Carro e ingrese una cantidad valida');
                    }
                    $uniSucursal->getMedicamentos()->updateExistingPivot($unidadMed, ['cantidadTotal' => ($cantidadTotal - $request->cantidad[$unidadMed])]);
                    //  if($med->pivot->cantidadTotal == 0 )
                    // {
                    //     $uniSucursal->getMedicamentos()->detach();
                    // }
                }
            }
        }
        $reserva = new Reserva();
        $reserva->numero_reserva = rand(1000, 9999999);
        $reserva->sucursal_id = $sucursal->id_sucursal;
        $reserva->usuario_id = \auth()->user()->id_usuario;
        $reserva->estados_id = 1;
        $reserva->fecha_solicitud_estados = date('Y-m-d');
        $reserva->fecha_caducidad_estados = date('Y-m-d', strtotime('+2 days'));
        $reserva->save();
        foreach ($request->medicamentos as $unidadMed) {
            $reserva->reservaMedicamentos()->attach($unidadMed, ['cantidad' => $request->cantidad[$unidadMed]]);
        }

        Mail::to($sucursal->email_sucursal)->send(new reservaRealizadaMailable($reserva));
        \Cart::clear();
        return redirect(route('cart.checkout'))->with('reservaconfirmada', 'Su Reserva a ha sido registrada, recibira una notificacion cuando pueda retirar su pedido.');
        // dd($arrSucursal);
    }

    public function cancelarReserva()
    {
        if (count(\Cart::getContent())) {
            foreach (\Cart::getContent() as $item) {
                $farmaciaEnCarrito = Farmacia::where('id_farmacia','=',$item->farmacia)->first();
                    foreach ($farmaciaEnCarrito->getSucursales as $sucursal) {
                        if ((DB::table('sucursal_medicamento')->where('medicamento_id', '=', $item->id)->where('sucursal_id', '=', $sucursal->id_sucursal)->first()) != []) {
                            $med = $sucursal->getMedicamentos()->where('medicamento_id', '=', $item->id)->first();
                            // $medReserva = $reserva->getMedicamentos()->where('medicamento_id','=',$medicamentos->id_medicamento)->first();
                            $cantidadTotal = $med->pivot->cantidadTotal;
                            $sucursal->getMedicamentos()->updateExistingPivot($item->id, ['cantidadTotal' => ($cantidadTotal + $item->quantity)]);
                        }
                    }                
            }
        }
        \Cart::clear();
        return back()->with('cancelar', "Su carrito de reservas a sido Vaciado. Recuerde que solo puede reservar en una farmacia a la vez.");
    }
}
