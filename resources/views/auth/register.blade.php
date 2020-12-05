@extends('welcome')
@section('iconPestaña')
@section('titulo',' Registrarse')
@section('contenido')

 <div class="row justify-content-center">
        <div class="col-md-6 col-12">
             <div class="shadow bg-white"> 
                <div class="col-12 bg-encabezado mb-3 p-3">
                        <h3 class="text-white text-center">REGISTRARSE</h3>
                        <p class="text-white text-center">Complete los siguientes campos</p>
                    </div> 
                <div class="card-body mb-2"> 
                    <!-- Masthead Subheading-->
                        <form method="POST" action="{{ route('register') }}">
                            @csrf
                            <!-- NOMBRE -->
                            <div class="form-group">
                                <strong><label for="nombre">{{ __('Nombre *') }}</label></strong>
                                <input id="nombre" type="text" class="form-control focus @error('nombre') is-invalid @enderror" 
                                        name="nombre" value="{{ old('nombre') }}" required autocomplete="nombre" autofocus placeholder="Ingrese su Nombre" autofocus>

                                @error('nombre')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <!-- APELLIDO -->
                            <div class="form-group">
                                <strong><label for="apellido">{{ __('Apellido *') }}</label></strong>
                                <input id="apellido" type="text" class="form-control @error('apellido') is-invalid @enderror" 
                                        name="apellido" value="{{ old('apellido') }}" required autocomplete="apellido" autofocus placeholder="Ingrese su Apellido">

                                @error('apellido')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <!-- NOMBRE DE USUARIO-->
                            <div class="form-group">
                                <strong><label for="nombre_usuario">{{ __('Nombre de Usuario *') }}</label></strong>
                                <input id="nombre_usuario" type="text" class="form-control @error('nombre_usuario') is-invalid @enderror" 
                                        name="nombre_usuario" value="{{ old('nombre_usuario') }}" required autocomplete="nombre_usuario" autofocus placeholder="Ingrese un nombre de usuario">

                                @error('nombre_usuario')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <!-- EMAIL -->
                            <div class="form-group">    
                                <strong><label for="email">{{ __('E-Mail *') }}</label></strong>
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" 
                                    required autocomplete="email" placeholder="micorreo@email.com">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <!-- Telefono -->
                            <div class="form-group">    
                                <strong><label for="telefono_movil">{{ __('Telefono *') }}</label></strong>
                                <input id="telefono_movil" type="telefono_movil" class="form-control @error('telefono_movil') is-invalid @enderror" name="telefono_movil" value="{{ old('telefono_movil') }}" 
                                    required autocomplete="telefono_movil" placeholder="(Cod-Area) Numero de telefono sin el 15">
                                    <small class="form-text text-muted">(Cod-Area) Numero de telefono sin el 15</small>

                                @error('telefono_movil')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <!-- LOCALIDAD -->
                            <div class="form-group">
                                <strong><label for="localidad">{{ __('Localidad *') }}</label></strong>
                                    <select id="localidad" class="form-control @error('localidad') is-invalid @enderror" name="localidad" value="{{ old('localidad') }}" required>                      
                                        @foreach ($localidades as $localidad)
                                            <option value="{{$localidad->codigo_postal}}">{{$localidad->nombre_localidad}}</option>        
                                        @endforeach 
                                    </select>
                                    <small class="form-text text-muted">Seleccione una localidad</small>
                            </div>
                            <!-- PASSWORD -->
                            <div class="form-group">
                                <strong><label for="password">{{ __('Contraseña *') }}</label><Strong>
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" 
                                        name="password" required autocomplete="new-password" placeholder="**************************************">
                                <small  class="form-text text-muted">Su contraseña debe tener entre 8 y 20 caracteres, contener letras y números, y no debe contener espacios, caracteres especiales</small>
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <strong><label for="password-confirm">{{ __('Confirmar Contraseña *') }}</label><strong>
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password" placeholder="**************************************">
                            </div>
                             <div class="form-group">
                                <div class="d-flex d-flex justify-content-left"> 
                                    <small  class="form-text text-muted">Los campos marcados con (*) son obligatorios</small>
                                </div>    
                            </div>
                             <div class="form-group">
                                <div class="d-flex d-flex justify-content-left"> 
                                    <a class="btn btn-link" href="{{route('farmaceutico')}}" >¿Sos farmaceutico?</a>
                                </div>
                            </div> 
                            <hr>
                            <div class="form-group">
                                <div class="d-flex d-flex justify-content-center pt-3">  
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Registrarse') }}
                                    </button>
                                    
                                </div>
                            </div>
                    </form>
                 </div>   
            </div>
        </div>
    </div>

@endsection
