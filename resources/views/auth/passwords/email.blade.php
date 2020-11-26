@extends('welcome')
@section('titulo','Reetablecer Contraseña')
@section('contenido')

 <div class="row justify-content-center">
        <div class="col-md-6 col-12">
                <div class="shadow bg-white">
                    <div class="col-12 bg-encabezado mb-3 p-3">
                    <h3 class="text-white text-center">{{ __('RESTABLECER CONTRASEÑA') }}</h3>
                    <p class="lead text-center">Ingrese su correo electrónico</p>
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                    </div> 
                    <div class="card-body mb-2">    
                        <form method="POST" action="{{ route('password.email') }}">
                            @csrf

                            <div class="form-group">
                                <strong><label for="email">{{ __('Dirección de E-mail') }}</label></strong>
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" placeholder="Ejemplo@email.com" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                                <small class="form-text text-muted">Correo electrónico con el que se registro en la plataforma</small>
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <hr>
                        <div class="form-group">
                                <div class="d-flex d-flex justify-content-center pt-3">  
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Enviar enlace') }}
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
