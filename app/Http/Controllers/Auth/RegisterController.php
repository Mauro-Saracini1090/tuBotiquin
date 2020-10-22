<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Registrado;
use App\Providers\RouteServiceProvider;
use App\Models\Usuario;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = "/";

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [

            'nombre' => ['required', 'string', 'max:255'],
            'apellido' => ['required', 'string', 'max:255'],
            'localidad' => ['required'],
            'nombreUsuario' => ['required'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:usuario'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],

        ]);
    }

    protected function validatorFarma(array $data)
    {
        return Validator::make($data, [

            'nombre' => ['required', 'string', 'max:255'],
            'apellido' => ['required', 'string', 'max:255'],
            'localidad' => ['required'],
            'nombreUsuario' => ['required'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:usuario'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'cuil' => ['required', 'string', 'min:8'],
            'cuit' => ['required', 'string', 'min:8'],
            'matricula' => ['required', 'string', 'min:8'],
            'dni' => ['required', 'string', 'min:8'],

        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\Usuario
     */
    protected function create(array $data)
    {
        return Usuario::create([
            'nombre' => $data['nombre'],
            'apellido' => $data['apellido'],
            'nombre_usuario' => $data['nombreUsuario'],
            'cod_postal' => $data['localidad'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'cuil' => null,
            'cuit' => null,
            'dni' => null,
            'numero_matricula' => null,
            'habilitado' => true,

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
