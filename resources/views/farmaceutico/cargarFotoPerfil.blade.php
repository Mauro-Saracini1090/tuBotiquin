@extends('farmaceutico.miPerfilFarmaceutico')
@section('titulo','Subir foto')

@section('subir_foto')
        <form  method="POST" action="{{ route('cargarFotoPerfil') }}" enctype="multipart/form-data">
            
            @csrf  
              <!-- IMG farmacia -->
                <div class="form-group">
                    <strong><label for="img_ferfil_form">{{ __('Suba una imagen *') }}</label></strong>
                    <input type="file" name="img_ferfil_form"   accept="image/*" class="form-control @error('img_ferfil_form')  is-invalid @enderror">
                     <small  class="form-text text-muted">Tamaño máximo 4MB </small>
                    <small  class="form-text text-muted">formato PNG, JPG y JPEG</small>
                    
                    @error('img_ferfil_form')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                     @enderror
                </div>

                <div class="form-group">
                    <div class="d-flex d-flex justify-content-center"> 
                        <button type="submit" class="btn btn-primary mx-1">Subir</button>
                        <a href="{{  route('miPerfilFarmacuetico') }}" class="btn btn-primary mx-1">Cancelar</a>
                    </div>
                </div>
        </form>   

@endsection


    