<?php
namespace App\Traits;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;


/**
 * 
 */
trait UsuarioHabilitado
{
    protected function comprobar(Request $request, $user)
    {
        //
        if (auth()->user()->habilitado == 0) {

            // usuario con sesión iniciada pero inactivo
        
            // cerramos su sesión
            $this->guard()->logout();
        
            // invalidamos su sesión
            $request->session()->invalidate();
        
            // redireccionamos a donde queremos
            return redirect('/')->with('estado','Disculpe las Molestias pero su usuario aun se encuentra DESHABILITADO y en proceso de evaluacion. Saludos Equipo Tu Botiquin.');
        }
    }

    /**
     * Handle a login request to the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Http\JsonResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function loginPersonalizado(Request $request)
    {
        $this->validateLogin($request);

        
        // If the class is using the ThrottlesLogins trait, we can automatically throttle
        // the login attempts for this application. We'll key this by the username and
        // the IP address of the client making these requests into this application.
        
        if (method_exists($this, 'hasTooManyLoginAttempts') &&
            $this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);
            return $this->sendLockoutResponse($request);
        }

        if ($this->attemptLogin($request)) {
            return $this->enviarRespuestaLogin($request);
        }

        // If the login attempt was unsuccessful we will increment the number of attempts
        // to login and redirect the user back to the login form. Of course, when this
        // user surpasses their maximum number of attempts they will get locked out.
        $this->incrementLoginAttempts($request);

        return $this->sendFailedLoginResponse($request);
    }

    /**
     * Send the response after the user was authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\JsonResponse
     */
    protected function enviarRespuestaLogin(Request $request)
    {
        $request->session()->regenerate();

        $this->clearLoginAttempts($request);

        if ($response = $this->comprobar($request, $this->guard()->user())) {
            return $response;
        }

        return $request->wantsJson()
                    ? new JsonResponse([], 204)
                    : redirect()->intended($this->redirectPath());
    }
    
    public function username()
    {
        //return 'email';
        //FILTER_VALIDATE_EMAIL - Valida una dirección de correo electrónico. En general, se valildan direcciones de correo electrónico con la sintaxis de RFC 822, con la excepción de no admitir el plegamiento de comentarios y espacios en blanco.
        $loginData = request()->input('login');
        $fieldName = filter_var($loginData, FILTER_VALIDATE_EMAIL) ? 'email' : 'nombre_usuario';
        request()->merge([$fieldName => $loginData]);
        return $fieldName;
    }

}
