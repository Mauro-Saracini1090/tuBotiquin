@extends('farmaceutico.indexFarmaceutico')
@section('titulo','Cargar Farmacia')

@section('opcionesFarmaceutico')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="shadow p-3 mb-5 backCard rounded"> 
                    
                        <!-- Masthead Subheading-->
                        <h3 class="masthead-subheading text-center">Cargar Obra Social a Farmacia</h3>
                        <p class="lead text-center">Seleccione su Farmacia y las Obras Sociales</p>
                        <form method="POST" action="{{route('agregarobrasocialfarmacia')}}">
                        @csrf
                            <div class="form-group">
                                <strong><label for="id_farmacia">{{ __('Seleccione su Farmacia') }}</label></strong>

                                    <select id="id_farmacia" class="form-control @error('Farmacia') is-invalid @enderror"
                                            name="id_farmacia" value="{{ old('id_farmacia') }}" required>
                                            <option></option> 
                                            @foreach($arrayFarmacias as $farmacia)
                                                <option value="{{ $farmacia->id_farmacia }}">
                                                    {{ $farmacia->nombre_farmacia }}
                                                </option>
                                            @endforeach
                                    </select>
                                    <small  class="form-text text-muted">Si no encuentra su farmacia, contacte al Administrador</small>
                            </div>
                            <p>A continuacion seleccione las obras sociales </p>
                            
                            @foreach($arrayObraSocial as $obraSocial)
                                <div class="form-group">    
                                    <input type="checkbox" name="id_obra_social[]" value="{{ $obraSocial->id_obra_social }}">
                                    <strong class="px-2"><label for="id_obra_social">{{ __($obraSocial->Nombre_obra_social) }}</label></strong>
                                    <hr>
                                </div>
                                @endforeach

                                <div class="form-group">
                                    <div class="d-flex d-flex justify-content-center"> 
                                        <button type="submit" class="btn btn-primary mr-1">
                                            {{ __('Cargar') }}
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

