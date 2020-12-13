@extends('admin.administrador')
@section('titulo', 'Crear Farmacias')
@section('datos')
<div class="container my-4">
    <div class="row justify-content-center">
        <div class=" col-12">
            <div class="shadow p-3 mb-5 backCard rounded"> 
                    
                <!-- Masthead Subheading-->
                <h3 class="masthead-subheading text-center">Cargar Sucursal</h3>                
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
                </div>
               <!-- Descripcion -->
                <div class="form-group">
                    <strong><label for="descripcion_sucursal">{{ __('Descripción') }}</label></strong>
                    <textarea class="form-control @error('descripcion_sucursal') is-invalid @enderror" name="descripcion_sucursal" type="textarea" placeholder="¡Aqui puede colocar el eslogan de su sucursal!"
                            name="descripcion_sucursal" value="{{ old('descripcion_sucursal') }}"rows="3"></textarea>
                            <small class="form-text text-muted">Aca puede colocar los diás y horarios de atención</small>

                        @error('descripcion_fsucursal')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                </div>

                <!-- Cufe -->
                 <div class="form-group">
                    <strong><label  for="cufe_sucursal">{{ __('Cufe sucursal') }}</label></strong>
                    <input type="text" name="cufe_sucursal" value="{{ old('cufe_sucursal') }}" required class="form-control  @error('cufe_sucursal') is-invalid @enderror">
                    <small  class="form-text text-muted">Sin espacios ni guiones, 11 dígitos</small>

                         @error('cufe_sucursal')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                </div>
                 <!-- EMAIL --> 
                <div class="form-group">
                    <strong><label for="email_sucursal">{{ __('E-mail') }}</label></strong>
                    <input type="email" name="email_sucursal" value="{{ old('email_sucursal') }}"  required placeholder="correo@ejemplo.com"class="form-control @error('email_sucursal') is-invalid @enderror" >
                    
                         @error('email_sucursal')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                </div>
                <!-- TELEFONO FIJO -->        
                <div class="form-group">
                    <strong><label for="telefono_fijo">{{ __('Teléfono fijo') }}</label></strong>
                    <input type="text" name="telefono_fijo" value="{{ old('telefono_fijo') }}" placeholder="Ejemplo: 29844586958" required class="form-control @error('telefono_fijo') is-invalid @enderror" >
                    <small  class="form-text text-muted">Sin espacios ni guiones,(Cod.Area sin 0), Numero de telefono sin 15. Entre 6 digitos minimo</small>
                         @error('telefono_fijo')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                </div>
                
                <!-- TELEFONO MOVIL -->        
                    <div class="form-group">
                    <strong><label for="telefono_movil">{{ __('Teléfono móvil') }}</label></strong>
                    <input type="text" name="telefono_movil" value="{{ old('telefono_movil') }}" placeholder="Ejemplo: 29844586958" required class="form-control @error('telefono_movil') is-invalid @enderror" >
                    <small  class="form-text text-muted">Sin espacios ni guiones,(Cod.Area sin 0), Numero de telefono sin 15. Entre 6 digitos minimo</small>
                         @error('telefono_movil')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                </div>

                <!-- Direccion -->
                <div class="form-group">
                    <strong><label for="direccion_sucursal">{{ __('Dirección *') }}</label></strong>
                <input type="text" name="direccion_sucursal" value="{{ old('direccion_sucursal') }}" placeholder="Ejemplo: Entre Av. Libertad y San Martin n° 154" required class="form-control @error('direccion_sucursal') is-invalid @enderror" >
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
                         <a href="{{ route('sucursal.index') }}" class="btn btn-primary">Cancelar</a>
                    </div>
                </div>
             </form>   
            </div>
        </div>
    </div>
</div>
@endsection
@section('zona_js')
<script src="//cdn.ckeditor.com/4.15.1/basic/ckeditor.js"></script>
<script>
    CKEDITOR.replace('descripcion_sucursal',{
        language: 'es',
        uiColor: '#9AB8F3',
        enterMode : CKEDITOR.ENTER_BR
    });
</script>
@endsection