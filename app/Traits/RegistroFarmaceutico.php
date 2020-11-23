<?php
namespace App\Traits;

use App\Mail\NotificacionNuevoFarmaceuticoAdministradorMailable;
use App\Mail\RegistroFarmaceuticoMailable;
use App\Models\Role;
use App\Models\Usuario;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
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
        
        $emailAdministrador = DB::table('usuario')
        ->join('usuario_roles', 'usuario.id_usuario', '=', 'usuario_roles.usuario_id')
        ->join('roles', 'usuario_roles.rol_id', '=', 'roles.id_rol')
        ->where('roles.slug_rol', '=', 'es-administrador')
        ->select('email')
        ->get();
           
        Mail::to($user->email)->send(new RegistroFarmaceuticoMailable);
        Mail::to($emailAdministrador)->send(new NotificacionNuevoFarmaceuticoAdministradorMailable);

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
            'nombre_usuario' => ['required','unique:usuario'],
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
            'nombre_usuario' => $data['nombre_usuario'],
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
