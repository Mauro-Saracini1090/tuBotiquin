@extends('admin.administrador')
@section('titulo', 'Editar Farmacias')
@section('datos')
<div class="container my-4">
    <div class="row justify-content-center">
         <div class=" col-12">
            <div class="shadow p-3 mb-5 backCard rounded">  
                    <!-- Masthead Subheading-->
                    <h3 class="masthead-subheading text-center">Editar Farmacia</h3>                    
                    <form  method="POST" action="{{ route('farmacia.update',[$farmacia]) }}" enctype="multipart/form-data">
                     @method('PATCH')
                     @csrf  
                    <div class="form-group">
                        <strong><label  for="nombre_farmacia">{{ __('Nombre de la Farmacia *') }}</label></strong>
                        <input type="text" name="nombre_farmacia" value="{{  old('nombre_farmacia', $farmacia->nombre_farmacia) }}" required class="form-control  @error('nombre_farmacia') is-invalid @enderror">
                            @error('nombre_farmacia')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                    </div>
                     <div class="form-group">
                        <strong><label for="img_farmacia">{{ __('Suba una imagen con su logo *') }}</label></strong>
                        <input type="file" name="img_farmacia" value="{{ old('img_farmacia' , $farmacia->img_farmacia )}}" class="form-control @error('img_farmacia')  accept="image/*" is-invalid @enderror" >
                        <small  class="form-text text-muted">Tamaño máximo 4MB</small>

                         @error('img_farmacia')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <strong><label for="descripcion_farmacia">{{ __('Descripción *') }}</label></strong>
                        <textarea class="form-control @error('descripcion_farmacia') is-invalid @enderror" name="descripcion_farmacia" type="textarea" placeholder="¡Aqui puede colocar el eslogan de su Farmacia!">{{ old('descripcion_farmacia' , $farmacia->descripcion_farmacia ) }}</textarea>

                            @error('descripcion_farmacia')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                    </div>
                    <div class="form-group">
                        <strong><label for="cuit">{{ __('CUIT *') }}</label></strong>
                        <input type="number" name="cuit" value="{{ old('cuit', $farmacia->cuit) }}" required class="form-control @error('cuit') is-invalid @enderror">
                        <small  class="form-text text-muted">Sin espacios ni guiones - 8 caracteres mínimo</small>
                         @error('cuit')
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
                              <button type="submit" class="btn btn-primary mx-1">Guardar cambios</button>
                              <a href="{{ url()->previous() }}" class="btn btn-primary mx-1">Volver Atrás</a>
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
    CKEDITOR.replace( 'descripcion_farmacia' );
</script>
@endsection
