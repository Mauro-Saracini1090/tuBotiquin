@extends('welcome')
@section('titulo','Contacto')

@section('contenido')

    <div class="row justify-content-center">
        <div class="col-md-8 col-12">
                <div class="shadow bg-white">
                    <div class="col-12 bg-encabezado mb-3 p-3">
                            <h3 class="text-white mb-0 text-center">CONTACTO</h3>      
                            <p class="text-white text-center">Por cualquier consulta, complete el formulario para contactarnos</p>
                    </div> 
                    <div class="card-body mb-2">
                        <form method="POST" action="{{ route('enviarEmailContacto')}}">
                        @csrf
                             <!-- Nombre -->
                            <div class="form-group">
                                <strong><label  for="nombre">{{ __('Nombre *') }}</label></strong>
                                <input type="text" name="nombre" value="{{ old('nombre') }}" placeholder="Su nombre" class="form-control @error('nombre') is-invalid @enderror" required >
                                
                                @error('nombre')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                @enderror
                            </div>

                             <!-- asunto -->
                            <div class="form-group">
                                <strong><label  for="">{{ __('Asunto *') }}</label></strong>
                                <input type="text" name="asunto" value="{{ old('asunto') }}" placeholder="¿Porque nos escribe?" class="form-control @error('asunto') is-invalid @enderror" required >
                                
                                @error('asunto')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                @enderror
                            </div>

                            <!-- Email -->
                            <div class="form-group">
                                <strong><label for="email">{{ __('E-mail *') }}</label></strong>
                                <input type="email" id="email"  placeholder="Ej: micorreo@mail.com" class="form-control @error('email') is-invalid @enderror" name="email" required
                                        required>
                                <small class="form-text text-muted">Le vamos a responder a este e-mail</small>       
                                @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                @enderror
                            </div>

                            <!-- Descripcion -->
                            <div class="form-group">
                                <strong><label for="consulta">{{ __('Consulta *') }}</label></strong>
                                <textarea  name="consulta" rows="7" placeholder="Deje su consulta o sugerencia aqui" class="form-control @error('consulta') is-invalid @enderror"
                                        value="{{ old('consulta') }}" required></textarea>
                               
                                    @error('consulta')
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
                            <div class="form-group ">
                                <div class="d-flex d-flex justify-content-center pt-3">  
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Enviar') }}
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

