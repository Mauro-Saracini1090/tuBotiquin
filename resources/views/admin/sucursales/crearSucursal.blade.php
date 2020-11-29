@extends('admin.administrador')
@section('titulo', 'Crear Farmacias')
@section('datos')
<div class="container my-4">
    <div class="row justify-content-center">
        <div class=" col-12">
            <div class="shadow p-3 mb-5 backCard rounded"> 
                    
                <!-- Masthead Subheading-->
                <h3 class="masthead-subheading text-center">Cargar Sucursal</h3>
                <p class="lead text-center">Complete los siguientes campos</p>
                
                <form method="POST" action="{{ route('sucursal.store') }}">
                @csrf

                <!-- select Farmacias -->
                <div class="form-group">
                        <strong><label for="id_farmacia">{{ __('Seleccione su Farmacia') }}</label></strong>

                        <select id="id_farmacia" class="form-control @error('Farmacia') is-invalid @enderror"
                                name="id_farmacia" value="{{ old('id_farmacia') }}" required>
                                <option></option> 
                                @foreach($arrayFarmacias as $farmacia)
                                <option value="{{ $farmacia->id_farmacia }}">
                                        {{ $farmacia->nombre_farmacia }}</option>
                                @endforeach
                        </select>
                        <small  class="form-text text-muted">Si no encuentra su farmacia, contacte al Administrador</small>
                </div>
               <!-- Descripcion -->
                <div class="form-group">
                    <strong><label for="descripcion_sucursal">{{ __('Descripción') }}</label></strong>
                    <textarea class="form-control" name="descripcion_sucursal" type="textarea" placeholder="¡Aqui puede colocar el eslogan de su sucursal!" @error('descripcion_sucursal') is-invalid @enderror
                            name="descripcion_sucursal" value="{{ old('descripcion_sucursal') }}"rows="3"></textarea>

                        @error('descripcion_fsucursal')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                </div>
                <!-- Cufe -->
                 <div class="form-group">
                    <strong><label  for="cufe_sucursal">{{ __('Cufe sucursal') }}</label></strong>
                    <input type="text" name="cufe_sucursal" value="{{ old('cufe_sucursal') }}" @error('cufe_sucursal') is-invalid @enderror required class="form-control">
                    <small  class="form-text text-muted">Sin espacios ni guiones, 8 dígitos mínimo</small>

                         @error('cufe_sucursal')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                </div>
                 <!-- EMAIL --> 
                <div class="form-group">
                    <strong><label for="email_sucursal">{{ __('E-mail') }}</label></strong>
                    <input type="email" name="email_sucursal" value="{{ old('email_sucursal') }}" @error('email_sucursal') is-invalid @enderror required placeholder="correo@ejemplo.com"class="form-control" >
                    
                         @error('email_sucursal')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                </div>
                 <!-- TELEFONO FIJO -->        
                 <div class="form-group">
                    <strong><label for="telefono_sucursal">{{ __('Teléfono') }}</label></strong>
                    <input type="text" name="telefono_sucursal" value="{{ old('telefono_sucursal') }}" @error('telefono_sucursal') is-invalid @enderror placeholder="Ejemplo: 29844586958" required class="form-control" >
                    <small  class="form-text text-muted">Sin espacios ni guiones, 8 dígitos mínimo</small>
                         @error('telefono_sucursal')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                </div>

                <!-- TELEFONO FIJO -->        
                <div class="form-group">
                    <strong><label for="telefono_fijo">{{ __('Teléfono fijo') }}</label></strong>
                    <input type="text" name="telefono_fijo" value="{{ old('telefono_fijo') }}" @error('telefono_fijo') is-invalid @enderror placeholder="Ejemplo: 29844586958" required class="form-control" >
                    <small  class="form-text text-muted">Sin espacios ni guiones, 8 dígitos mínimo</small>
                         @error('telefono_fijo')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                </div>
                
                <!-- TELEFONO MOVIL -->        
                    <div class="form-group">
                    <strong><label for="telefono_movil">{{ __('Teléfono móvil') }}</label></strong>
                    <input type="text" name="telefono_movil" value="{{ old('telefono_movil') }}" @error('telefono_movil') is-invalid @enderror placeholder="Ejemplo: 29844586958" required class="form-control" >
                    <small  class="form-text text-muted">Sin espacios ni guiones, 8 dígitos mínimo</small>
                         @error('telefono_movil')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                </div>

                <!-- Direccion -->
                <div class="form-group">
                    <strong><label for="direccion_sucursal">{{ __('Dirección *') }}</label></strong>
                <input type="text" name="direccion_sucursal" value="{{ old('direccion_sucursal') }}" @error('direccion_sucursal') is-invalid @enderror placeholder="Ejemplo: Entre Av. Libertad y San Martin n° 154" required class="form-control" >
                    <small  class="form-text text-muted">Calle y número</small>

                        @error('direccion_sucursal')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                </div>
              
                 <div class="form-group">
                    <div class="d-flex d-flex justify-content-center"> 
                        <button type="submit" class="btn btn-primary mr-1">
                            {{ __('Registrar') }}
                        </button>
                         <a href="{{ route('farmacia.index') }}" class="btn btn-primary">Cancelar</a>
                    </div>
                </div>
             </form>   
            </div>
        </div>
    </div>
</div>
@endsection
