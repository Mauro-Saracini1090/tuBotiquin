@extends('admin.administrador')
@section('titulo', 'Editar Farmacias')
@section('datos')
<div class="container my-4">
    <div class="row justify-content-center">
        <div class=" col-12">
            <div class="shadow p-3 mb-5 backCard rounded">

                <!-- Masthead Subheading-->
                <h3 class="masthead-subheading text-center">Editar Sucursal</h3>
                <p class="lead text-center">Complete los siguientes campos</p>

                <form method="POST" action="{{ route('sucursal.update', [$sucursal]) }}">
                    @method('PATCH')
                    @csrf
                    <!-- Descripcion -->
                    <div class="form-group">
                        <strong><label
                                for="descripcion_sucursal">{{ __('Descripción *') }}</label></strong>
                        <textarea class="form-control" name="descripcion_sucursal" type="textarea"
                            placeholder="¡Aqui puede colocar el eslogan de su sucursal!" @error('descripcion_sucursal')
                            is-invalid @enderror name="descripcion_sucursal"
                            value={{ old('descripcion_sucursal') }}
                            rows="3">
                            {{$sucursal->descripcion_sucursal}}
                        </textarea>

                        @error('descripcion_sucursal')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <!-- Cufe -->
                    <div class="form-group">
                        <strong><label
                                for="cufe_sucursal">{{ __('Cufe sucursal *') }}</label></strong>
                        <input type="text" name="cufe_sucursal"
                            value={{ old('cufe_sucursal', $sucursal->cufe_sucursal ) }} required class="form-control @error('cufe_sucursal') is-invalid @enderror">
                        <small class="form-text text-muted">Sin espacios ni guiones, 8 dígitos mínimo</small>

                        @error('cufe_sucursal')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <!-- EMAIL -->
                    <div class="form-group">
                        <strong><label for="email_sucursal">{{ __('E-mail') }}</label></strong>
                        <input type="email" name="email_sucursal"
                            value={{ old('email_sucursal *', $sucursal->email_sucursal) }}
                            @error('email_sucursal') is-invalid @enderror required placeholder="correo@ejemplo.com"
                            class="form-control">

                        @error('email_sucursal')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <!-- TELEFONO FIJO -->
                    <div class="form-group">
                        <strong><label
                                for="telefono_fijo">{{ __('Teléfono fijo *') }}</label></strong>
                        <input type="text" name="telefono_fijo"
                            value={{ old('telefono_fijo', $sucursal->telefono_fijo) }}
                            @error('telefono_sucursal') is-invalid @enderror required class="form-control">
                        <small class="form-text text-muted">Sin espacios ni guiones</small>
                        @error('telefono_fijo')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                   <!-- TELEFONO MÓVIL--> 
                    <div class="form-group">
                        <strong><label
                                for="telefono_movil">{{ __('Teléfono móvil*') }}</label></strong>
                        <input type="text" name="telefono_movil"
                            value={{ old('telefono_movil', $sucursal->telefono_movil) }}
                            @error('telefono_movill') is-invalid @enderror required class="form-control">
                        <small class="form-text text-muted">Sin espacios ni guiones</small>
                        @error('telefono_movil')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <!-- Direccion -->
                    <div class="form-group">
                        <strong><label
                                for="direccion_sucursal">{{ __('Dirección *') }}</label></strong>
                        <input type="text" name="direccion_sucursal"
                            value="{{ old('direccion_sucursal', $sucursal->direccion_sucursal) }}"
                            @error('direccion_sucursal') is-invalid @enderror
                            placeholder="Ejemplo: Entre Av. Libertad y San Martin n° 154" required class="form-control">
                        <small class="form-text text-muted">Calle y número</small>

                        @error('direccion_sucursal')
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
                                {{ __('Guardar Cambios') }}
                            </button>
                            <a href="{{ route('sucursal.index') }}"
                                class="btn btn-primary">Cancelar</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
