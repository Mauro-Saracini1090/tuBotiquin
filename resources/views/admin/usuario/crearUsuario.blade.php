@extends('admin.administrador')
@section('datos')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">{{ __('Crear Usuario') }}</div>

            <div class="card-body">
                <form method="POST" action="{{ route('usuario.store') }}">
                    @csrf

                    <div class="form-group row">
                        <label for="nombre"
                            class="col-md-4 col-form-label text-md-right">{{ __('Nombre') }}</label>

                        <div class="col-md-6">
                            <input id="nombre" type="text" class="form-control @error('nombre') is-invalid @enderror"
                                name="nombre" value="{{ old('nombre') }}" required
                                autocomplete="nombre" autofocus>

                            @error('nombre')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="apellido"
                            class="col-md-4 col-form-label text-md-right">{{ __('Apellido') }}</label>

                        <div class="col-md-6">
                            <input id="apellido" type="text"
                                class="form-control @error('apellido') is-invalid @enderror" name="apellido"
                                value="{{ old('apellido') }}" required autocomplete="apellido"
                                autofocus>

                            @error('apellido')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="localidad"
                            class="col-md-4 col-form-label text-md-right">{{ __('Localidad') }}</label>
                        <div class="col-md-6">

                            <select id="localidad" class="form-control @error('localidad') is-invalid @enderror"
                                name="localidad" value="{{ old('localidad') }}" required>
                                @foreach($localidades as $localidad)
                                    <option value="{{ $localidad->codigo_postal }}">
                                        {{ $localidad->nombre_localidad }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="nombreUsuario"
                            class="col-md-4 col-form-label text-md-right">{{ __('Nombre de Usuario') }}</label>

                        <div class="col-md-6">
                            <input id="nombreUsuario" type="text"
                                class="form-control @error('nombreUsuario') is-invalid @enderror" name="nombreUsuario"
                                value="{{ old('nombreUsuario') }}" required
                                autocomplete="nombreUsuario" autofocus>

                            @error('nombreUsuario')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="email"
                            class="col-md-4 col-form-label text-md-right">{{ __('Direccion de E-Mail') }}</label>

                        <div class="col-md-6">
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                                name="email" value="{{ old('email') }}" required autocomplete="email">

                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="password"
                            class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                        <div class="col-md-6">
                            <input id="password" type="password"
                                class="form-control @error('password') is-invalid @enderror" name="password" required
                                autocomplete="new-password">

                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="password-confirm"
                            class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                        <div class="col-md-6">
                            <input id="password-confirm" type="password" class="form-control"
                                name="password_confirmation" required autocomplete="new-password">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="cuil"
                            class="col-md-4 col-form-label text-md-right">{{ __('CUIL') }}</label>

                        <div class="col-md-6">
                            <input id="cuil" type="text" class="form-control @error('cuil') is-invalid @enderror"
                                name="cuil" value="{{ old('cuil') }}" autocomplete="cuil" autofocus>

                            @error('cuil')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="cuit"
                            class="col-md-4 col-form-label text-md-right">{{ __('CUIT') }}</label>

                        <div class="col-md-6">
                            <input id="cuit" type="text" class="form-control @error('cuit') is-invalid @enderror"
                                name="cuit" value="{{ old('cuit') }}" autocomplete="cuit" autofocus>

                            @error('cuit')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="dni"
                            class="col-md-4 col-form-label text-md-right">{{ __('DNI') }}</label>

                        <div class="col-md-6">
                            <input id="dni" type="text" class="form-control @error('dni') is-invalid @enderror"
                                name="dni" value="{{ old('dni') }}" autocomplete="dni" autofocus>

                            @error('dni')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="matricula"
                            class="col-md-4 col-form-label text-md-right">{{ __('Numero Matricula') }}</label>

                        <div class="col-md-6">
                            <input id="matricula" type="text"
                                class="form-control @error('matricula') is-invalid @enderror" name="matricula"
                                value="{{ old('matricula') }}" autocomplete="matricula" autofocus>

                            @error('matricula')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="habilitado"
                            class="col-md-4 col-form-label text-md-right">{{ __('Habilitar') }}</label>
                        <div class="col-md-6">

                            <select id="habilitado" class="form-control @error('habilitado') is-invalid @enderror"
                                name="habilitado" value="{{ old('habilitado') }}" required>
                                <option value="no">NO</option>
                                <option value="si">SI</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group row mb-0">
                        <div class="col-md-6 offset-md-4">
                            <button type="submit" class="btn btn-panel">
                                {{ __('Register') }}
                            </button>
                            <a href="{{ route('usuario.index') }}" class="btn btn-secondary">Volver Atras</a>
                        </div>
                    </div>
                </form>
                
            </div>
        </div>
    </div>
</div>
@endsection
