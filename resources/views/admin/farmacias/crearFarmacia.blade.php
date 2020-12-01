@extends('admin.administrador')
@section('titulo', 'Crear Farmacias')
@section('datos')
<div class="container my-4">
    <div class="row justify-content-center">
        <div class=" col-12">
            <div class="shadow p-3 mb-5 backCard rounded">
                <!-- Masthead Subheading-->
                <h3 class="masthead-subheading text-center">Crear Farmacia</h3>
                <p class="lead text-center">Edite los siguientes campos</p>

                <form method="POST" action="{{ route('almacenarFarmaciaAdmin') }}"
                    enctype="multipart/form-data">
                    @csrf
                    {{-- <!-- select Farmaceuticos -->
                    <div class="form-group">
                        <strong><label for="farmaceutico">{{ __('Seleccione su Farmaceutico') }}</label></strong>
                        <select id="farmaceutico" class="form-control @error('farmaceutico') is-invalid @enderror"
                            name="farmaceutico" value="{{ old('farmaceutico') }}" required>
                            <option></option>
                            @foreach($farmaceuticos as $farmaceutico)
                                <option value="{{ $farmaceutico->id_usuario  }}">
                                    {{ $farmaceutico->nombre }} {{ $farmaceutico->apellido }}-
                                    {{ $farmaceutico->numero_matricula }}
                                </option>
                            @endforeach
                        </select>
                        @error('farmaceutico')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div> --}}
                    <div class="form-group">
                        <strong><label
                                for="nombre_farmacia">{{ __('Nombre de la Farmacia *') }}</label></strong>
                        <input type="text" name="nombre_farmacia"
                            value="{{ old('nombre_farmacia') }}" required class="form-control @error('nombre_farmacia') is-invalid @enderror">
                        @error('nombre_farmacia')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <strong><label
                                for="img_farmacia">{{ __('Suba una imagen con su logo *') }}</label></strong>
                        <input type="file" name="img_farmacia"
                            value="{{ old('img_farmacia') }}" class="form-control  @error('img_farmacia')is-invalid @enderror" accept="image/*">
                        <small class="form-text text-muted">Tamaño máximo 4MB</small>

                        @error('img_farmacia')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <strong><label
                                for="descripcion_farmacia">{{ __('Descripción *') }}</label></strong>
                        <textarea class="form-control @error('descripcion_farmacia') is-invalid @enderror" name="descripcion_farmacia" type="textarea"
                            placeholder="¡Aqui puede colocar el eslogan de su Farmacia!"  name="descripcion_farmacia">{{ old('descripcion_farmacia') }}</textarea>

                        @error('descripcion_farmacia')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <strong><label for="cuit">{{ __('CUIT *') }}</label></strong>
                        <input type="number" name="cuit"
                            value="{{ old('cuit') }}" required class="form-control @error('cuit') is-invalid @enderror">
                        <small class="form-text text-muted">Sin espacios ni guiones - 8 caracteres mínimo</small>
                        @error('cuit')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <strong><label for="habilitada">{{ __('Habilitar Farmacia') }}</label></strong>
                        <select id="habilitada" class="form-control @error('habilitada') is-invalid @enderror"
                            name="habilitada" value="{{ old('habilitada') }}" required>
                            <option></option>
                            <option value="1">SI</option>
                            <option value="0">NO</option>
                        </select>
                        @error('habilitada')
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
                            <button type="submit" class="btn btn-primary mx-1">Guardar cambios</button>
                            <a href="{{ url()->previous() }}" class="btn btn-primary mx-1">Volver Atrás</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
