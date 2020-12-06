@extends('welcome')
@section('titulo', 'Home')

@section('contenido')
    <div class="row justify-content-center">
        <div class="col-md-10 col-12">
            <div class="shadow bg-white">
                <div class="col-12 bg-encabezado mb-3 p-3">
                    <h2 class="text-center text-white"> EDITAR PERFIL</h2>
                    <p class="text-white text-center">Complete los siguientes campos</p>
                </div>
                <div class="card-body">
                    @canany(['esFarmaceutico','esRegistrado'])
                        <form method="POST" action="{{ route('actualizarPerfil', [$usuario]) }}">
                            @csrf
                            @method('PATCH')
                            <div class="row">
                                <div Class="col-lg-6 col-12">
                                    <div class="text ml-3">
                                        <ul class="list-group list-group-flush">
                                            <li class="list-group-item">
                                                <!-- NOMBRE -->
                                                <div class="form-group">
                                                    <strong><label for="nombre">{{ __('Nombre *') }}</label></strong>
                                                    <input id="nombre" type="text"
                                                        class="form-control focus @error('nombre') is-invalid @enderror"
                                                        name="nombre" value="{{ old('nombre', $usuario->nombre) }}" required
                                                        autocomplete="nombre" autofocus placeholder="Ingrese su Nombre"
                                                        autofocus>

                                                    @error('nombre')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </li>
                                            <li class="list-group-item">
                                                <!-- APELLIDO -->
                                                <div class="form-group">
                                                    <strong><label for="apellido">{{ __('Apellido *') }}</label></strong>
                                                    <input id="apellido" type="text"
                                                        class="form-control @error('apellido') is-invalid @enderror"
                                                        name="apellido" value="{{ old('apellido', $usuario->apellido) }}"
                                                        required autocomplete="apellido" autofocus
                                                        placeholder="Ingrese su Apellido">

                                                    @error('apellido')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>

                                            </li>
                                            <li class="list-group-item">
                                                <!-- EMAIL -->
                                                <div class="form-group">
                                                    <strong><label
                                                            for="email">{{ __('Direccion de E-Mail *') }}</label></strong>
                                                    <input id="email" type="email"
                                                        class="form-control @error('email') is-invalid @enderror" name="email"
                                                        value="{{ old('email', $usuario->email) }}" required required
                                                        autocomplete="email" placeholder="micorreo@email.com">

                                                    @error('email')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </li>
                                            <li class="list-group-item">
                                                <!-- NOMBRE DE USUARIO-->
                                                <div class="form-group">
                                                    <strong><label
                                                            for="nombre_usuario">{{ __('Nombre de Usuario *') }}</label></strong>
                                                    <input id="nombre_usuario" type="text"
                                                        class="form-control @error('nombre_usuario') is-invalid @enderror"
                                                        name="nombre_usuario"
                                                        value="{{ old('nombre_usuario', $usuario->nombre_usuario) }}" required
                                                        autocomplete="nombre_usuario" autofocus
                                                        placeholder="Ingrese un nombre de usuario">

                                                    @error('nombre_usuario')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </li>
                                            <li class="list-group-item">
                                                <!-- LOCALIDAD -->
                                                <div class="form-group">
                                                    <strong><label for="localidad">{{ __('Localidad *') }}</label></strong>
                                                    <select id="localidad"
                                                        class="form-control @error('localidad') is-invalid @enderror"
                                                        name="localidad" value="{{ old('localidad') }}" required>
                                                        @foreach ($localidades as $localidad)
                                                            <option value="{{ $localidad->codigo_postal }}" @if($usuario->cod_postal == $localidad->codigo_postal) selected @endif>
                                                                {{ $localidad->nombre_localidad }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                    <small class="form-text text-muted">Seleccione una localidad</small>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <div Class="col-lg-6 col-12">
                                    <div class="text ml-3">
                                        <ul class="list-group list-group-flush">
                                            <li class="list-group-item">
                                                <!-- Telefono -->
                                                <div class="form-group">
                                                    <strong><label for="telefono_movil">{{ __('Telefono *') }}</label></strong>
                                                    <input id="telefono_movil" type="telefono_movil"
                                                        class="form-control @error('telefono_movil') is-invalid @enderror"
                                                        name="telefono_movil"
                                                        value="{{ old('telefono_movil', $usuario->telefono_movil) }}" required
                                                        autocomplete="telefono_movil"
                                                        placeholder="(Cod-Area) Numero de telefono sin el 15">
                                                    <small class="form-text text-muted">(Cod-Area) Numero de telefono sin el
                                                        15</small>

                                                    @error('telefono_movil')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </li>
                                            @can('esFarmaceutico')
                                            <li class="list-group-item">
                                                <!-- DNI -->
                                                <div class="form-group">
                                                    <strong><label for="cuil">{{ __('DNI *') }}</label></strong>
                                                    <input id="cuil" type="text"
                                                        class="form-control @error('dni') is-invalid @enderror" name="dni"
                                                        value="{{ old('dni', $usuario->dni) }}" readonly autocomplete="dni"
                                                        autofocus placeholder="Ej:12345678" required readonly="readonly">
                                                    <small class="form-text text-muted">Sin espacios ni guiones, 8 dígitos
                                                        mínimo</small>
                                                    @error('dni')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </li>
                                            <li class="list-group-item">
                                                <!-- CUIL -->
                                                <div class="form-group">
                                                    <strong><label for="cuil">{{ __('CUIL *') }}</label></strong>
                                                    <input id="cuil" type="text"
                                                        class="form-control @error('cuil') is-invalid @enderror" name="cuil"
                                                        value="{{ old('cuil', $usuario->cuil) }}" readonly autocomplete="cuil"
                                                        autofocus placeholder="Ej:12345678" required readonly="readonly">
                                                    <small class="form-text text-muted">Sin espacios ni guiones, 8 dígitos
                                                        mínimo</small>
                                                    @error('cuil')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </li>
                                            <li class="list-group-item">
                                                <!-- CUIT -->
                                                <div class="form-group">
                                                    <strong><label for="cuit">{{ __('CUIT *') }}</label></strong>
                                                    <input id="cuit" type="readonly"
                                                        class="form-control @error('cuit') is-invalid @enderror" name="cuit"
                                                        value="{{ old('cuit', $usuario->cuit) }}" autocomplete="cuit" autofocus
                                                        placeholder="Ej:12345678" required readonly="readonly">
                                                    <small class="form-text text-muted">Sin espacios ni guiones, 8 dígitos
                                                        mínimo</small>
                                                    @error('cuit')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </li>
                                            <li class="list-group-item">
                                                <!-- matricula -->
                                                <div class="form-group">
                                                    <strong><label
                                                            for="numero_matricula">{{ __('Número de Matricula *') }}</label></strong>
                                                    <input id="numero_matricula" type="readonly"
                                                        class="form-control @error('numero_matricula') is-invalid @enderror"
                                                        name="numero_matricula" value="{{ $usuario->numero_matricula }}"
                                                        readonly autocomplete="numero_matricula" autofocus
                                                        placeholder="Ej: mn345678" required readonly="readonly">
                                                    <small class="form-text text-muted">Sin espacios ni guiones</small>

                                                    @error('numero_matricula')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </li>
                                            @endcan
                                        </ul>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="d-flex d-flex justify-content-left">
                                    <small class="form-text text-muted">Los campos marcados con (*) son obligatorios</small>
                                </div>
                            </div>
                            <hr>
                            <div class="form-group">
                                <div class="d-flex d-flex justify-content-center pt-3">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Actualizar') }}
                                    </button>
                                    <a href="{{ route('miPerfilFarmacuetico') }}" class="btn btn-primary mx-1">Cancelar</a>
                                </div>
                            </div>
                        </form>
                    @endcanany
                </div>
            </div>
        </div>
    </div>
@endsection
