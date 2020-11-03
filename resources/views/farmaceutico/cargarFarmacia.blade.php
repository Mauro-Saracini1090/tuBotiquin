@extends('welcome')
@section('titulo','Cargar Farmacia')

@section('contenido')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10 col-12">
                <div class="shadow p-3 mb-5 bg-white rounded"> 
                    
                        <!-- Masthead Subheading-->
                        <h3 class="masthead-subheading  my-3 text-center">Cargar Farmacia</h3>
                        <p class="lead text-center">Complete los siguientes campos</p>
                        
                        <form method="POST" action="{{ route('farmacia.store') }}">
                        @csrf
                        <form>
                        <div class="form-group">
                           
                            <label  for="exampleInputEmail1">{{ __('Nombre Farmacia') }}</label></p>
                            <input type="text" value="{{ old('nombre_farmacia') }}" @error('nombre_farmacia') is-invalid @enderror required class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                             @error('nombre_farmacia')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlTextarea1">{{ __('Descripción') }}</label>
                            <textarea class="form-control" type="textarea" id="exampleFormControlTextarea1"  @error('descripcion_farmacia') is-invalid @enderror"
                                    name="nombre_farmacia" value="{{ old('descripcion_farmacia') }}"rows="3"></textarea>

                                @error('descripcion_farmacia')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">{{ __('CUIT') }}</label>
                            <input type="text" value="{{ old('cuit') }}" @error('cuit') is-invalid @enderror required class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                             @error('nombre_farmacia')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                        </div>
                       <!--

                        <div class="form-group row">
                            <label for="nombre_farmacia" class="col-md-4 col-form-label text-md-right">{{ __('Nombre Farmacia') }}</label>

                            <div class="col-md-6">
                                <input id="nombre_farmacia" type="text" class="form-control @error('nombre_farmacia') is-invalid @enderror"
                                    name="nombre_farmacia" value="{{ old('nombre_farmacia') }}" required
                                    autocomplete="nombre_farmacia" autofocus>

                                @error('nombre_farmacia')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                          <div class="form-group row">
                            <label for="descripcion_farmacia" class="col-md-4 col-form-label text-md-right">{{ __('Descripción') }}</label>

                            <div class="col-md-6">
                                <input id="descripcion_farmacia" type="textarea" maxlength ="30"  class="form-control @error('descripcion_farmacia') is-invalid @enderror"
                                    name="nombre_farmacia" value="{{ old('descripcion_farmacia') }}"
                                    autocomplete="descripcion_farmacia" autofocus>

                                @error('descripcion_farmacia')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="cuit" class="col-md-4 col-form-label text-md-right">{{ __('CUIT') }}</label>

                            <div class="col-md-6">
                                <input id="cuit" type="text" class="form-control @error('cuit') is-invalid @enderror" name="cuit" value="{{ old('cuit') }}" required autocomplete="cuil" autofocus> 

                                @error('cuit')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                            -->
                         <div class="form-group">
                            <div class="">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Registrar') }}
                                </button>
                                 <a href="" class="btn btn-primary">Cancelar</a>
                            </div>
                        </div>
                        </form>   
                    </div>
                
            </div>   
        </div>                
    </div>
@endsection    