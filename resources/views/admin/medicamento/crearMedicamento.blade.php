@extends('admin.administrador')
@section('titulo', 'Crear Medicamento')
@section('datos')
<div class="container my-4">
    <div class="row justify-content-center">
        <div class=" col-12">
            <div class="shadow p-3 mb-5 backCard rounded">
                <!-- Masthead Subheading-->
                <h3 class="masthead-subheading text-center">Crear Medicamento</h3>
                <p class="lead text-center">Edite los siguientes campos</p>

                <form method="POST" action="{{ route('medicamentos.store') }}"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <strong>
                            <label for="nombre_medicamento">{{ __('Nombre de Medicamento *') }}
                            </label>
                        </strong>
                        <input class="form-control @error('nombre_medicamento') is-invalid @enderror" type="text"
                            name="nombre_medicamento" value="{{ old('nombre_medicamento') }}">

                        @error('nombre_medicamento')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <strong>
                            <label for="informacion">{{ __('Informacion *') }}</label>
                        </strong>
                        <textarea class="form-control @error('informacion') is-invalid @enderror" name="informacion"
                            type="textarea" placeholder="¡Aqui puede colocar la Informacion del Medicamento"
                            name="informacion"></textarea>

                        @error('informacion')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                      <!-- IMG Medicamento -->
                    <div class="form-group">
                        <strong><label for="img_medicamento">{{ __('Suba una imagen medicamento *') }}</label></strong>
                        <input type="file" name="img_medicamento"  accept="image/*" class="form-control  @error('img_medicamento') is-invalid @enderror" required>
                        <small  class="form-text text-muted">Tamaño máximo 4MB</small>

                         @error('img_medicamento')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                        @enderror
                    </div>

                    <!-- select Tipo -->
                    <div class="form-group">
                        <strong><label
                                for="id_tipo">{{ __('Seleccione Tipo Medicamento') }}</label></strong>

                        <select id="id_tipo" class="form-control @error('id_tipo') is-invalid @enderror"
                            name="id_tipo" value="{{ old('id_tipo') }}">
                            <option></option>
                            @foreach($tipos as $tipo)
                                <option value="{{ $tipo->id_tipo }}"> {{ $tipo->nombre_tipo }}</option>
                            @endforeach
                        </select>
                        {{-- <small class="form-text text-muted">Si no encuentra el Tipo que esta buscando, contacte al Administrador</small> --}}
                        @error('id_tipo')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <!-- select Marca -->
                    <div class="form-group">
                        <strong>
                            <label for="id_marca">{{ __('Seleccione la Marca') }}</label>
                        </strong>

                        <select id="id_marca" class="form-control @error('id_marca') is-invalid @enderror"
                            name="id_marca" value="{{ old('id_marca') }}">
                            <option></option>
                            @foreach($marcas as $marca)
                                <option value="{{$marca->id_marca}}">{{ $marca->nombre_marca }}</option>
                            @endforeach
                        </select>
                        {{-- <small class="form-text text-muted">Si no encuentra la Marca que esta buscando, contacte al Administrador</small> --}}
                        @error('id_marca')
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
