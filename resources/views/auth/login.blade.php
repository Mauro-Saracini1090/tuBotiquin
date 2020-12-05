@extends('welcome')
@section('titulo',' Ingresar')
@section('iconPestaña') 
@section('contenido')
    <div class="row justify-content-center">
        <div class="col-md-6 col-12">
                <div class="shadow bg-white">
                    <div class="col-12 bg-encabezado mb-3 p-3">
                            <h3 class="text-white mb-0 text-center">INGRESAR</h3>      
                            <p class="text-white text-center">Complete los siguientes campos</p>
                    </div> 
                    <div class="card-body mb-2">
                        <!-- Masthead Subheading--> 
                        
                      
                       
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="form-group">
                            <strong><label for="login">E-mail o Nombre de Usuario</label></strong>
                            <input type="text"  class="form-control  @if ($errors->has('login') || $errors->has('email')) is-invalid @endif"
                             id="exampleInputEmail1" aria-describedby="emailHelp"  name="login" placeholder="Ingrese su nombre de usuario o correo "
                                    value="{{ old('login') ?: old('email') }}"
                                    required autocomplete="email" autofocus>

                             @if ($errors->has('login') || $errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('login') ?: $errors->first('email') }}</strong>
                                    </span>
                             @endif    
                        </div>

                        <div class="form-group">
                            <strong><label for="password">{{ __('Contraseña') }}</label></strong>
                            <input type="password" id="inputPassword2" placeholder="Ingrese su contraseña" class="form-control @error('password') is-invalid @enderror" name="password"
                                    required autocomplete="current-password">
                             <small class="form-text text-muted">Nunca revele su contraseña</small>       
                            @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember"
                                        {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Recordar Inicio de Sesión') }}
                                    </label>
                             </div>
                              <div class="d-flex d-flex justify-content-left">   
                                 @if(Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('¿Olvido su contraseña?') }}
                                    </a>
                                @endif
                            </div>
                        </div>
                       <hr>
                        <div class="form-group ">
                            <div class="d-flex d-flex justify-content-center pt-3">  
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Iniciar Sesión') }}
                                </button>
                            </div>    
                        </div> 
                    </div>
                </form>
             </div>
        </div>
    </div>

@endsection
