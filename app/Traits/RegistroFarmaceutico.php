<?php
namespace App\Traits;

use App\Models\Role;
use App\Models\Usuario;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

/**
 * 
 */
trait RegistroFarmaceutico
{   
    public function showRegisFarmaceuticoForm()
    {
        $localidades = DB::table('localidad')->get();
        return view('auth.registerFarma', compact('localidades'));
    }

    public function registroFarmaceutico(Request $request)
    {
        $this->validatorFarma($request->all())->validate();

        event(new Registered($user = $this->createFarm($request->all())));
        
        $rolFarma = Role::where('id_rol', 2)->first();
        
        $user->getRoles()->attach($rolFarma);
        


        if ($response = $this->registered($request, $user)) {
            return $response;
        }

        return $request->wantsJson()
            ? new JsonResponse([], 201)
            : redirect($this->redirectPath());
    }


    protected function validatorFarma(array $data)
    {
        return Validator::make($data, [

            'nombre' => ['required', 'string', 'max:255'],
            'apellido' => ['required', 'string', 'max:255'],
            'localidad' => ['required'],
            'nombreUsuario' => ['required','unique:usuario'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:usuario'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'cuil' => ['required', 'string', 'min:8'],
            'cuit' => ['required', 'string', 'min:8'],
            'matricula' => ['required', 'string', 'min:8'],
            'dni' => ['required', 'string', 'min:8'],

        ]);
    }
    protected function createFarm(array $data)
    {

        return Usuario::create([
            'nombre' => $data['nombre'],
            'apellido' => $data['apellido'],
            'nombre_usuario' => $data['nombreUsuario'],
            'cod_postal' => $data['localidad'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'cuil' => $data['cuil'],
            'cuit' => $data['cuit'],
            'dni' => $data['dni'],
            'numero_matricula' => $data['matricula'],
            'habilitado' => false,

        ]);
    }
}
