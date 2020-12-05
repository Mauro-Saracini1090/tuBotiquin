@extends('welcome')
@section('titulo','Reetablecer Contraseña')
@section('contenido')

<div class="row justify-content-center">
        <div class="col-md-6 col-12">
                <div class="shadow bg-white">
                    <div class="col-12 bg-encabezado mb-3 p-3">
                        <h3 class="text-white mb-0 text-center">{{ __('RESTABLECER CONTRASEÑA') }}</h3>
                        <p class="text-white text-center">Por favor, ingrese su cuenta de correo y luego la nueva contraseña</p>
                     </div> 
                    <div class="card-body mb-2">
                        
                            <form method="POST" action="{{ route('password.update') }}">
                                @csrf

                                <input type="hidden" name="token" value="{{ $token }}">

                                <div class="form-group">
                                    <strong><label for="email">{{ __('Direccipon de E-mail *') }}</label></strong>
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus>

                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <strong><label for="password">{{ __('Contraseña *') }}</label></strong>
                                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <strong><label for="password-confirm">{{ __('Confirmar Contraseña *') }}</label></strong>
                                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                                </div>

                                <div class="form-group">
                                    <div class="d-flex d-flex justify-content-left"> 
                                        <small  class="form-text text-muted">Los campos marcados con (*) son obligatorios</small>
                                    </div>    
                                </div>
                                <hr>

                                <div class="form-group ">
                                    <div class="d-flex d-flex justify-content-center p-3">   
                                        <button type="submit" class="btn btn-primary">
                                            {{ __('Cambiar Contraseña') }}
                                        </button>
                                    </div>
                                </div>
                            </form> 
                        </div>
                    </div>
                </div>
            </div>
        </div>
@endsection