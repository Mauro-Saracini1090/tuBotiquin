@extends('farmaceutico.indexFarmaceutico')
@section('titulo','Cargar Sucursal')

@section('opcionesFarmaceutico')
        <div class="container">
        <div class="row justify-content-center">
            <div class=" col-12">
                <div class="shadow p-3 mb-5 bg-white rounded"> 
                    
                        <!-- Masthead Subheading-->
                        <h3 class="masthead-subheading text-center">EDITAR SUCURSAL</h3>
                        <p class="lead text-center">Complete los siguientes campos</p>
                        
                        <form method="POST" action="{{ route('sucursal.update', [$sucursal]) }}">
                        @method('PATCH')
                        @csrf

                       <!-- Descripcion -->
                        <div class="form-group">
                            <strong><label for="descripcion_sucursal">{{ __('Descripción *') }}</label></strong>
                            <textarea  name="descripcion_sucursal"  class="form-control @error('descripcion_sucursal') is-invalid required @enderror"
                                    value={{ old('descripcion_sucursal', $sucursal->descripcion_sucursal) }} rows="3"></textarea>
                            <small  class="form-text text-muted">Aca puede colocar los días y horarios de atención</small>

                            @error('descripcion_sucursal')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <!-- Cufe -->
                         <div class="form-group">
                            <strong><label  for="cufe_sucursal">{{ __('Cufe sucursal *') }}</label></strong>
                            <input type="text" name="cufe_sucursal" value={{ old('cufe_sucursal', $sucursal->cufe_sucursal ) }} class="form-control @error('cufe_sucursal') is-invalid @enderror" required>
                            <small  class="form-text text-muted">Sin espacios ni guiones, 8 dígitos mínimo</small>

                             @error('cufe_sucursal')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                         <!-- EMAIL --> 
                        <div class="form-group">
                            <strong><label for="email_sucursal">{{ __('E-mail *') }}</label></strong>
                            <input type="email" name="email_sucursal" value={{ old('email_sucursal *', $sucursal->email_sucursal) }} placeholder="correo@ejemplo.com" class="form-control @error('email_sucursal') is-invalid @enderror" required>
                            
                            @error('email_sucursal')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                         <!-- TELEFONO -->        
                         <div class="form-group">
                            <strong><label for="telefono_sucursal">{{ __('Teléfono *') }}</label></strong>
                            <input type="text" name="telefono_sucursal" value={{ old('telefono_sucursal', $sucursal->telefono_sucursal) }} class="form-control @error('telefono_sucursal') is-invalid @enderror" required>
                            <small  class="form-text text-muted">Sin espacios ni guiones</small>
                                 @error('telefono_sucursal')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                        </div>
                          <!-- Direccion -->
                        <div class="form-group">
                            <strong><label for="direccion_sucursal">{{ __('Dirección *') }}</label></strong>
                        <input type="text" name="direccion_sucursal" value="{{ old('direccion_sucursal', $sucursal->direccion_sucursal) }}" placeholder="Ejemplo: Entre Av. Libertad y San Martin n° 154" class="form-control  @error('direccion_sucursal') is-invalid @enderror" required>
                            <small class="form-text text-muted">Calle y número</small>

                                @error('direccion_sucursal')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                        </div>
                        <div class="form-group">
                            <div class="d-flex d-flex justify-content-left"> 
                                <small  class="form-text text-muted">Los campos marcados con (*) son obligatorios</small>
                            </div>    
                        </div>
                      
                         <div class="form-group">
                            <div class="d-flex d-flex justify-content-center"> 
                                <button type="submit" class="btn btn-primary mr-1">
                                    {{ __('Guardar Cambios') }}
                                </button>
                                 <a href="{{ route('farmacia.index') }}" class="btn btn-primary">Cancelar</a>
                            </div>
                        </div>
                     </form>   
                </div>
            </div>   
        </div>                
    </div>
<script src="//cdn.ckeditor.com/4.15.1/basic/ckeditor.js"></script> 
<script>
    CKEDITOR.replace( 'descripcion_sucursal' );
</script>
@endsection