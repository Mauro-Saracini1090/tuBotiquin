@extends('admin.administrador')

@section('datos')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-2 border-bottom">
    <h1 class="h2">Nuevo Tipo Medicamento</h1>
</div>

    
    <form class="form-signin" method="post" action="{{route('tipoMedicamentos.store') }}">
        @csrf
        <div class="form-group">
            <label for="nombre_tipo">Nombre Tipo Medicamento:</label>
            <input class="form-control @error('nombre_tipo') is-invalid @enderror" type="text" name="nombre_tipo" id="nombre_tipo" placeholder="Nombre Tipo Medicamento"
                value="{{ old('nombre_tipo')}}">
        </div>
        <div class="form-group">
            @if($errors->has('nombre_tipo'))
                <p class="text text-danger">{{ $errors->first('nombre_tipo') }}</p>
            @endif
        </div>
        <button type="submit" class="btn btn-panel mx-1">Cargar Tipo Medicamento</button>
        <a href="{{ url()->previous() }}" class="btn btn-secondary mx-1">Volver Atras</a>
    </form>
@endsection