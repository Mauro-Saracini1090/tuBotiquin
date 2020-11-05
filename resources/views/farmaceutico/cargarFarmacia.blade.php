@extends('welcome')
@section('titulo','Cargar Farmacia')

@section('contenido')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 col-12">
                <div class="shadow p-3 mb-5 bg-white rounded"> 
                    
                        <!-- Masthead Subheading-->
                        <h3 class="masthead-subheading text-center">Cargar Farmacia</h3>
                        <p class="lead text-center">Complete los siguientes campos</p>
                        
                        <form method="POST" action="{{ route('farmacia.store')}}" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group">
                            <strong><label  for="nombre_farmacia">{{ __('Nombre de la Farmacia') }}</label></strong>
                            <input type="text" name="nombre_farmacia" value="{{ old('nombre_farmacia') }}" @error('nombre_farmacia') is-invalid @enderror required class="form-control">
                             @error('nombre_farmacia')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <strong><label for="img_farmacia">{{ __('Suba una imagen con su logo') }}</label></strong>
                            <input type="file" name="img_farmacia" @error('img_farmacia') accept="image/*" is-invalid @enderror required class="form-control" >
                            <small  class="form-text text-muted">Tamaño máximo 4MB</small>

                             @error('img_farmacia')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <strong><label for="descripcion_farmacia">{{ __('Descripción') }}</label></strong>
                            <textarea class="form-control" name="descripcion_farmacia" type="textarea" placeholder="¡Aqui puede colocar el eslogan de su Farmacia!" @error('descripcion_farmacia') is-invalid @enderror
                                    name="escripcion_farmacia" value="{{ old('descripcion_farmacia') }}"rows="3"></textarea>

                            @error('descripcion_farmacia')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <strong><label for="cuit">{{ __('CUIT') }}</label></strong>
                            <input type="number" name="cuit" value="{{ old('cuit') }}" @error('cuit') is-invalid @enderror required class="form-control" >
                            <small  class="form-text text-muted">Sin espacios ni guiones</small>
                             @error('cuit')
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