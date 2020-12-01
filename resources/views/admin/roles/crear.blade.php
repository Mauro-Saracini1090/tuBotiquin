@extends('admin.administrador')
@section('datos')
<h3>Crear Rol</h3>

<form class="form-signin" method="post" action="{{ route('roles.store') }}">

    {!! csrf_field() !!}
    <div class="form-group">
        <label for="nombre_rol" style="color: white">Nombre Rol:</label>
        <input class="form-control" type="text" name="nombre_rol" id="nombre_rol" placeholder="Nombre Rol"
            value="{{ old('nombre_rol') }}">
    </div>
    <div class="form-group">
        @if($errors->has('nombre_rol'))
            <p class="text text-danger">{{ $errors->first('nombre_rol') }}</p>
        @endif
    </div>
    <div class="form-group">
        <label for="slug_rol" style="color: white">Slug:</label>
        <input class="form-control" type="text" name="slug_rol" id="slug_rol" placeholder="Slug"
            value="{{ old('slug_rol') }}">

        @if($errors->has('slug_rol'))
            <p class="text text-danger">{{ $errors->first('slug_rol') }}</p>
        @endif

    </div>
    <button type="submit" class="btn btn-panel mx-1">Crear Rol</button><a href="{{ url()->previous() }}"
        class="btn btn-secondary mx-1">Volver Atras</a>
</form>


@endsection
@section('zona_js')
<script>
    $(document).ready(function () {
        $('#nombre_rol').keyup(function (e) {
            var str = $('#nombre_rol').val();
            str = 'es-'+ str.replace(/\W+(?!$)/g, '-').toLowerCase();
            $('#slug_rol').val(str);
            // $('#slug_rol').attr('placeholder', str);
        });
    });

</script>
@endsection