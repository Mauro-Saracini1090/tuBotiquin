<?php

namespace App\Http\Middleware;

use App\Traits\RolesPermisos;
use Closure;
use Illuminate\Http\Request;


class RolMiddleware
{
    use RolesPermisos;
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     * Se agrega un tercer parametro,El tercer parametro en este caso representa el rol que resive de la ruta.
     * Se debera agregar un parametro  por cada rol enviado desde la ruta separado por coma.
     * Para solucionar esto podemos usamos el metodo func_get_arg() que recive todos los parametros enviados a una
     * funcion (esten definidos o no)
     * Otra forma es usar splat operator que se usa para desempaquetar a listas de argumentos 
     * al invocar a funciones, el operador "..." A esto también se le conoce como el operador 'splat' 
     */
    public function handle(Request $request, Closure $next, ...$roles)
    {
        // se usa array_slice para quitar o no tomar del arreglo los dos primeros elementos
        //$roles = array_slice(func_get_args(),2);

        foreach ($roles as $rol) {

            if (auth()->user()->tieneRole($rol)){
                return $next($request);
            }
        }

        abort(404);
    }
}
