@extends('welcome')
@section('titulo',' Registrarse Farmaceutico')
@section('contenido')

  <div class="row justify-content-center">
        <div class="col-md-8 col-12">
             <div class="shadow p-3 mb-5 bg-white rounded"> 
                <div class="card-body mb-2"> 
                    <!-- Masthead Subheading-->
                    <h3 class="masthead-subheading mb-0  text-center">Registrarse</h3>
                    <p class="text-muted text-center">Complete los siguientes campos</p>
    
                        <form method="POST" action="{{ route('registroFarmaceutico') }}">
                            @csrf
                            <!-- NOMBRE -->
                            <div class="form-group">
                                <strong><label for="nombre">{{ __('Nombre') }}</label></strong>
                                <input id="nombre" type="text" class="form-control focus @error('nombre') is-invalid @enderror" 
                                        name="nombre" value="{{ old('nombre') }}" required autocomplete="nombre" autofocus placeholder="Ingrese su Nombre">

                                @error('nombre')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <!-- APELLIDO -->
                            <div class="form-group">
                                <strong><label for="apellido">{{ __('Apellido') }}</label></strong>
                                <input id="apellido" type="text" class="form-control @error('apellido') is-invalid @enderror" 
                                        name="apellido" value="{{ old('apellido') }}" required autocomplete="apellido" autofocus placeholder="Ingrese su Apellido">

                                @error('apellido')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <!-- LOCALIDAD -->
                            <div class="form-group">
                                <strong><label for="localidad">{{ __('Localidad') }}</label></strong>
                                    <select id="localidad" class="form-control @error('localidad') is-invalid @enderror" name="localidad" value="{{ old('localidad') }}" required>
                                        @foreach ($localidades as $localidad)
                                            <option value="{{$localidad->codigo_postal}}">{{$localidad->nombre_localidad}}</option>        
                                        @endforeach 
                                    </select>
                            </div>
                            <!-- NOMBRE DE USUARIO-->
                            <div class="form-group">
                                <strong><label for="nombre_usuario">{{ __('Nombre de Usuario') }}</label></strong>
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
                                <strong><label for="email">{{ __('Direccion de E-Mail') }}</label></strong>
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" 
                                    required autocomplete="email" placeholder="micorreo@email.com">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <!-- PASSWORD -->
                            <div class="form-group">
                                <strong><label for="password">{{ __('Contraseña') }}</label><Strong>
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
                                <strong><label for="password-confirm">{{ __('Confirmar Contraseña') }}</label><strong>
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password" placeholder="**************************************">
                            </div>

                            <!-- CUIL -->
                            <div class="form-group">
                                <strong><label for="cuil">{{ __('CUIL') }}</label></strong>
                                <input id="cuil" type="text" class="form-control @error('cuil') is-invalid @enderror" name="cuil" value="{{ old('cuil') }}"  autocomplete="cuil" autofocus required >
                                <small  class="form-text text-muted">Sin espacios ni guiones</small>    
                                @error('cuil')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <!-- CUIT -->
                            <div class="form-group ">
                                <strong><label for="cuit">{{ __('CUIT') }}</label></strong>
                                <input id="cuit" type="text" class="form-control @error('cuit') is-invalid @enderror" name="cuit" value="{{ old('cuit') }}"  autocomplete="cuit" autofocus required >
                                <small  class="form-text text-muted">Sin espacios ni guiones</small>
                                @error('cuit')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <!-- DNI -->
                            <div class="form-group ">
                                <strong><label for="dni">{{ __('DNI') }}</label></strong>
                                <input id="dni" type="text" class="form-control @error('dni') is-invalid @enderror" name="dni" value="{{ old('dni') }}"  autocomplete="dni" autofocus required >
                                <small  class="form-text text-muted">Sin puntos</small>

                                @error('dni')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                             </div>

                            <!-- matricula -->
                            <div class="form-group">
                                <strong><label for="matricula">{{ __('Numero Matricula') }}</label></strong>       
                                <input id="matricula" type="text" class="form-control @error('matricula') is-invalid @enderror" name="matricula" value="{{ old('matricula') }}"  autocomplete="matricula" autofocus required>
                                <small  class="form-text text-muted">Sin espacios ni guiones</small>

                                @error('matricula')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                        <div class="form-group">
                            <div class="d-flex d-flex justify-content-center">  
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Registrarse') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            
    </div>
@endsection
