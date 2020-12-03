@extends('farmaceutico.indexFarmaceutico')
@section('titulo','Contactar Administrador')

@section('opcionesFarmaceutico')
    <div class="container">
        <div class="row justify-content-center">
             <div class=" col-12">
                <div class="shadow bg-white">
                    <div class="col-12 bg-encabezado mb-3 p-3">
                            <h3 class="text-white mb-0 text-center">CONTACTAR AL ADMINISTRADOR</h3>      
                            <p class="text-white text-center">Complete los siguientes campos</p>
                    </div> 
                    <div class="card-body mb-2">      
                        @can('esFarmaceutico')
                        <form method="POST" action="{{ route('enviarEmailAdministrador') }}">
                            @csrf
                            <input type="hidden" name="email" value="{{$usuario->email}}">
                            <input type="hidden" name="numero_matricula" value="{{$usuario->numero_matricula}}">
                            <!-- EMAIL -->
                            <div class="form-group">
                                <strong><label for="email">{{ __('E-mail *') }}</label></strong>
                                <input type="email" name="email" value="{{ old('email', $usuario->email) }}"
                                    class="form-control @error('email_sucursal') is-invalid @enderror" disabled>
                                    <small class="form-text text-muted">Recibirá una respuesta a este correo</small>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <!-- Motivo -->
                            <div class="form-group">
                                <strong><label for="motivo">{{ __('Seleccione un motivo *') }}</label></strong>
                                <div class="pl-4">
                                    <label for="farmacia">Farmacias</label> 
                                    <input class="ml-2" type="radio" name="motivo" value="Farmacia" required>
                                </div> 
                                <div class="pl-4">
                                    <label for="sucursal">Sucursales</label>
                                    <input class="ml-2" type="radio" name="motivo" value="Sucursal">   
                                </div>
                                <div class="pl-4">
                                    <label for="medicamento">Medicamentos</label>
                                    <input class="ml-2" type="radio" name="motivo" value="Medicamentos">    
                                </div>
                                <div class="pl-4"> 
                                    <label for="stock">Stocks de medicametos</label>
                                    <input class="ml-2" type="radio" name="motivo" value="Stocks de medicamentos">  
                                </div>
                                <div class="pl-4"> 
                                    <label for="datosa">Datos farmaceutico</label>
                                    <input class="ml-2" type="radio" name="motivo" value="Datos farmaceutico">  
                                </div>
                                <div class="pl-4"> 
                                    <label for="otra">Otra</label>
                                    <input class="ml-2" type="radio" name="motivo" value="otra">  
                                </div>
        
                                @error('motivo')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div> 
                            
                            
                            <!-- Consulta -->
                            <div class="form-group"> 
                                <strong><label for="consulta">{{ __('Consulta *') }}</label></strong>
                                <textarea name="consulta"  placeholder="Detalle su consulta o sugerencia aqui" rows="10"
                                        value="{{ old('consulta') }}"  class="form-control @error('consulta') is-invalid @enderror" required></textarea>

                                @error('consulta')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                @enderror
                            </div>


                            <div class="form-group">
                                <div class="d-flex d-flex justify-content-left">
                                    <small class="form-text text-muted">Los campos marcados con (*) son obligatorios</small>
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <div class="d-flex d-flex justify-content-center">
                                    <button type="submit" class="btn btn-primary mr-1">
                                        {{ __('Enviar') }}
                                    </button>
                                    <a href="{{ route('panel.farmaceutico') }}"
                                        class="btn btn-primary">Cancelar</a>
                                </div>
                            </div>
                        </form>
                        @endcan
                </div>
             </div>            
        </div>
    </div>
@endsection    

