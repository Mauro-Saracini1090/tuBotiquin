@extends('admin.administrador')
@section('datos')
<h3>Crear Rol</h3>

@if($errors->any())
    <div class="alert alert-danger">
        <p>Por favor corrija los siguientes errores de abajo: </p>
    </div>
@endif


<form class="form-signin" method="post" action="{{ route('permisos.store') }}">

    {!! csrf_field() !!}
    <div class="form-group">
        <label for="nombre_perm" style="color: white">Nombre de Permiso:</label>
        <input class="form-control" type="text" name="nombre_perm" id="nombre_perm" placeholder="Nombre de Permiso"
            value="{{ old('nombre_perm') }}">
    </div>
    <div class="form-group">
        @if($errors->has('nombre_perm'))
            <p class="text text-danger">{{ $errors->first('nombre_perm') }}</p>
        @endif
    </div>
    <div class="form-group">
        <label for="slug_perm" style="color: white">Slug de Permiso:</label>
        <input class="form-control" type="text" name="slug_perm" id="slug_perm" placeholder="Slug de Permiso" value="{{ old('slug_perm') }}">

        @if($errors->has('slug_perm'))
            <p class="text text-danger">{{ $errors->first('slug_perm') }}</p>
        @endif

    </div>
    <button type="submit" class="btn btn-panel mx-1">Crear Permiso</button>
    <a href="{{ url()->previous() }}" class="btn btn-secondary mx-1">Volver Atras</a>
</form>


@endsection
@section('zona_js')
<script>
    $(document).ready(function () {
        $('#nombre_perm').keyup(function (e) {
            var str = $('#nombre_perm').val();
            str = str.replace(/\W+(?!$)/g, '-').toLowerCase();
            $('#slug_perm').val(str);
            $('#slug_perm').attr('placeholder', str);
        });
    });

</script>
@endsection
