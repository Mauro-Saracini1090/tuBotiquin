@extends('admin.administrador')

@section('datos')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-2 border-bottom">
    <h1 class="h2">Editar Localidad {{ $localidad->nombre_localidad }}</h1>
</div>
@if($errors->any())
    <div class="alert alert-danger">
        <p>Por favor corrija los siguientes errores de abajo: </p>
    </div>
@endif

    <form class="form-signin" method="post"
        action="{{ route('localidad.update', [$localidad->codigo_postal]) }}">
        @method('PATCH')
        @csrf
        <div class="form-group">
            <label for="nombre_localidad">Nombre Localidad:</label>
            <input class="form-control" type="text" name="nombre_localidad" id="nombre_localidad" placeholder="Nombre Localidad"
                value="{{ old('nombre_localidad', $localidad->nombre_localidad)  }}">
        </div>
        <div class="form-group">
            @if($errors->has('nombre_localidad'))
                <p class="text text-danger">{{ $errors->first('nombre_localidad') }}</p>
            @endif
        </div>
        <div class="form-group">
            <label for="codigo_postal">Código Postal:</label>
            <input class="form-control" type="number" name="codigo_postal" id="codigo_postal" placeholder="código postal" value="{{ old('codigo_postal', $localidad->codigo_postal) }}">

            @if($errors->has('codigo_postal'))
                <p class="text text-danger">{{ $errors->first('codigo_postal') }}</p>
            @endif

        </div>
        <button type="submit" class="btn btn-panel mx-1">Editar Localidad</button>
        <a href="{{ url()->previous() }}" class="btn btn-secondary mx-1">Volver Atras</a>
    </form>

@endsection