@extends('admin.administrador')

@section('datos')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-2 border-bottom">
    <h1 class="h2">Crear Obra Social </h1>
</div>
    <form class="form-signin" method="post" action="{{route('obrasocial.store') }}">
        @csrf
        <div class="form-group">
            <label for="Nombre_obra_social">Nombre Obra Social:</label>
            <input class="form-control" type="text" name="Nombre_obra_social" id="Nombre_obra_social" placeholder="Nombre Obra Social"
                value="{{ old('Nombre_obra_social')  }}">
        </div>
        <div class="form-group">
            @if($errors->has('Nombre_obra_social'))
                <p class="text text-danger">{{ $errors->first('Nombre_obra_social') }}</p>
            @endif
        </div>
        <div class="form-group">
            <label for="Telefono_obra_Social">Telefono:</label>
            <input class="form-control" type="number" name="Telefono_obra_Social" id="Telefono_obra_Social" placeholder="Telefono" value="{{ old('Telefono_obra_Social') }}">
            <small class="form-text text-muted">(Cod. Area sin 0) Numero sin el 15, entre 6 y 11 digitos</small>

            @if($errors->has('Telefono_obra_Social'))
                <p class="text text-danger">{{ $errors->first('Telefono_obra_Social') }}</p>
            @endif

        </div>
        <button type="submit" class="btn btn-panel mx-1">Cargar Nueva Obra Social</button>
        <a href="{{ route('obrasocial.index') }}" class="btn btn-secondary mx-1">Volver Atras</a>
    </form>

@endsection