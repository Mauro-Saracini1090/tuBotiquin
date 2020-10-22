@extends('welcome')
@section('datos')
<h3 style="color: white">Editar Rol {{ $role->nombre_rol }}</h3>

@if($errors->any())
    <div class="alert alert-danger">
        <p>Por favor corrija los siguientes errores de abajo: </p>
    </div>
@endif


<form class="form-signin" method="post"
    action="{{ route('roles.update', [$role->id_rol]) }}">
    @method('PATCH')
    @csrf
    <div class="form-group">
        <label for="nombre_rol" style="color: white">Nombre Rol:</label>
        <input class="form-control" type="text" name="nombre_rol" id="nombre_rol" placeholder="Nombre Rol"
            value="{{ old('nombre_rol',$role->nombre_rol) }}">
    </div>
    <div class="form-group">
        @if($errors->has('nombre_rol'))
            <p class="text text-danger">{{ $errors->first('nombre_rol') }}</p>
        @endif
    </div>
    <div class="form-group">
        <label for="slug_rol" style="color: white">Slug:</label>
        <input class="form-control" type="text" name="slug_rol" id="slug_rol" placeholder="Slug"
            value="{{ old('slug_rol',$role->slug_rol) }}">

        @if($errors->has('slug_rol'))
            <p class="text text-danger">{{ $errors->first('slug_rol') }}</p>
        @endif

    </div>
    <button type="submit" class="btn btn-success mx-1">Editar Rol</button><a href="{{ url()->previous() }}"
        class="btn btn-primary mx-1">Volver Atras</a>
</form>


@endsection
@section('zona_js')
<script>
    $(document).ready(function () {
        $('#nombre_rol').keyup(function (e) {
            var str = $('#nombre_rol').val();
            str = str.replace(/\W+(?!$)/g, '-').toLowerCase();
            $('#slug_rol').val(str);
            $('#slug_rol').attr('placeholder', str);
        });
    });

</script>
@endsection
