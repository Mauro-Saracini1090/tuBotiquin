@extends('admin.administrador')

@section('datos')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-2 border-bottom">
    <h1 class="h2">Nueva Marca Medicamento</h1>
</div>

    
    <form class="form-signin" method="post" action="{{route('marcaMedicamentos.store') }}">
        @csrf
        <div class="form-group">
            <label for="nombre_marca">Nombre Marca Medicamento:</label>
            <input class="form-control @error('nombre_marca') is-invalid @enderror" type="text" name="nombre_marca" id="nombre_marca" placeholder="Nombre Marca Medicamento"
                value="{{ old('nombre_marca')}}">
        </div>
        <div class="form-group">
            @if($errors->has('nombre_marca'))
                <p class="text text-danger">{{ $errors->first('nombre_marca') }}</p>
            @endif
        </div>
        <button type="submit" class="btn btn-panel mx-1">Cargar Marca de Medicamento</button>
        <a href="{{ url()->previous() }}" class="btn btn-secondary mx-1">Volver Atras</a>
    </form>
@endsection