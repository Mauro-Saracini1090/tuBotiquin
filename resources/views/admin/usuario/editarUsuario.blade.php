@extends('admin.administrador')
@section('datos')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">{{ __('Crear Usuario') }}</div>

            <div class="card-body">
                <form method="POST" action="{{ route('usuario.update',[$usuario]) }}">
                    @csrf
                    @method('PATCH')
                    <div class="form-group row">
                        <label for="nombre"
                            class="col-md-4 col-form-label text-md-right">{{ __('Nombre') }}</label>

                        <div class="col-md-6">
                            <input id="nombre" type="text" class="form-control @error('nombre') is-invalid @enderror"
                                name="nombre" value="{{ $usuario->nombre , old('nombre') }}"
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
                                value="{{ $usuario->apellido ,old('apellido') }}" 
                                autocomplete="apellido" autofocus>

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
                        <div class="col-md-6">                            <select id="localidad" class="form-control @error('localidad') is-invalid @enderror" name="localidad">
                                @foreach($localidades as $localidad)
                                    <option value="{{ $localidad->codigo_postal }}" @if($usuario->cod_postal == $localidad->codigo_postal) selected @endif> {{ $localidad->nombre_localidad }}</option>
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
                                value="{{ $usuario->nombre_usuario , old('nombreUsuario') }}"
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
                                name="email" value="{{ $usuario->email , old('email') }}"
                                 autocomplete="email">

                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="cuil"
                            class="col-md-4 col-form-label text-md-right">{{ __('CUIL') }}</label>

                        <div class="col-md-6">
                            <input id="cuil" type="text" class="form-control @error('cuil') is-invalid @enderror"
                                name="cuil" value="{{ $usuario->cuil , old('cuil') }}"
                                autocomplete="cuil" autofocus>

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
                                name="cuit" value="{{ $usuario->cuit ,old('cuit') }}"
                                autocomplete="cuit" autofocus>

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
                                name="dni" value="{{ $usuario->dni ,old('dni') }}"
                                autocomplete="dni" autofocus>

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
                                value="{{ $usuario->numero_matricula ,old('matricula') }}"
                                autocomplete="matricula" autofocus>

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
                                name="habilitado" value="{{ old('habilitado') }}" >
                                @if($usuario->habilitado == 1)
                                    <option value="si">SI</option>
                                    <option value="no">NO</option>
                                @else
                                    <option value="no">NO</option>
                                    <option value="si">SI</option>
                                @endif


                            </select>
                        </div>
                    </div>

                    <div class="form-group row mb-0">
                        <div class="col-md-6 offset-md-4">
                            <button type="submit" class="btn btn-panel">
                                {{ __('Editar Usuario') }}
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
