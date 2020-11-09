@extends('welcome')
@section('titulo','Reetablecer Contraseña')
@section('contenido')

<div class="row justify-content-center">
    <div class="col-md-6 col-12">
        <div class="shadow p-1 mb-5 bg-white rounded"> 
            <div class="card-body mb-2">
                    <h3 class="masthead-subheading text-center">{{ __('Restablecer Contraseña') }}</h3>
                    <p class="lead text-center">Ingrese su correo electronico</p>
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('password.email') }}">
                        @csrf

                        <div class="form-group">
                            <label for="email">{{ __('Dirección de E-mail') }}</label>
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" placeholder="Ejemplo@email.com" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                             <small class="form-text text-muted">Correo electronico con el que se registro en la plataforma</small>
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    
                       <div class="form-group">
                            <div class="d-flex d-flex justify-content-center">  
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
@endsection
