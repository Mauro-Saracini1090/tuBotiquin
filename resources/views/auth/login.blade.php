@extends('welcome')
@section('titulo',' Ingresar')
@section('iconPestaña') 
@section('contenido')
    <div class="row justify-content-center">
        <div class="col-md-9">
            
               
                <div class="shadow p-3 mb-5 bg-white rounded"> 
                    <div class="card-body mb-2">
                               <!-- Masthead Subheading-->
                                 <h3 class="masthead-subheading  mb-0 text-center">Ingresar</h3>
                                 <p class="lead text-center">Complete los siguientes campos</p>
                                 <hr>
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="login"
                                class="col-md-4 col-form-label text-md-right">{{ __('E-mail / Nombre de Usuario') }}
                            </label>

                            <div class="col-md-6">
                                <input id="login" type="text"
                                    class="form-control @if ($errors->has('login') || $errors->has('email')) is-invalid @endif"
                                    name="login"
                                    value="{{ old('login') ?: old('email') }}"
                                    required autocomplete="email" autofocus>

                                    @if ($errors->has('login') || $errors->has('email'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('login') ?: $errors->first('email') }}</strong>
                                        </span>
                                    @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password"
                                class="col-md-4 col-form-label text-md-right">{{ __('Contraseña') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password"
                                    class="form-control @error('password') is-invalid @enderror" name="password"
                                    required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember"
                                        {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Recordar Inicio de Sesion') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Iniciar Sesion') }}
                                </button>
                             </div>
                        </div>        
                        <div class="form-group row mb-0">
                            <div class=" offset-md-4 col-md-8 ">    
                                @if(Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Olvido su contraseña?') }}
                                    </a>
                                @endif
                            </div>
                        </div>
                    </form>
                    </div>
                </div>
          
    </div>
    
@endsection
