@extends('admin.administrador')

@section('datos')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-2 border-bottom">
    <h1 class="h2">Editar Obra Social {{ $obrasocial->Nombre_obra_social }}</h1>
</div>
@if($errors->any())
    <div class="alert alert-danger">
        <p>Por favor corrija los siguientes errores de abajo: </p>
    </div>
@endif
    
    <form class="form-signin" method="post" action="{{route('obrasocial.update',[$obrasocial->id_obra_social]) }}">
        @method('PATCH')
        @csrf
        <div class="form-group">
            <label for="Nombre_obra_social">Nombre Obra Social:</label>
            <input class="form-control" type="text" name="Nombre_obra_social" id="Nombre_obra_social" placeholder="Nombre Obra Social"
                value="{{ old('Nombre_obra_social', $obrasocial->Nombre_obra_social)  }}">
        </div>
        <div class="form-group">
            @if($errors->has('Nombre_obra_social'))
                <p class="text text-danger">{{ $errors->first('Nombre_obra_social') }}</p>
            @endif
        </div>
        <div class="form-group">
            <label for="Telefono_obra_Social">Telefono:</label>
            <input class="form-control" type="number" name="Telefono_obra_Social" id="Telefono_obra_Social" placeholder="Telefono" value="{{ old('Telefono_obra_Social', $obrasocial->Telefono_obra_Social) }}">

            @if($errors->has('Telefono_obra_Social'))
                <p class="text text-danger">{{ $errors->first('Telefono_obra_Social') }}</p>
            @endif

        </div>
        <button type="submit" class="btn btn-panel mx-1">Editar Obra Social</button>
        <a href="{{ url()->previous() }}" class="btn btn-secondary mx-1">Volver Atras</a>
    </form>

@endsection