@extends('admin.administrador')
@section('datos')
<div class="card" style="width: 100%;">
    <div class="card-body">
        <h4 class="card-title"> Asignar Roles y Permisos para el Usuario: {{ $usuario->nombre }}
            {{ $usuario->apellido }}</h4>

        <form class="form-signin" method="post" action="{{ route('usuario.almacenarrolpermisos') }}">
            @csrf
            <input type="hidden" name="usuario" value="{{ $usuario->id_usuario }}">
            <label for="rol" class="col-form-label">{{ __('Roles') }}</label>
            <div class="">
                <select id="rol" class="form-control @error('rol') is-invalid @enderror" name="rol"
                    value="{{ old('rol') }}">
                    <option value="">Seleccione un Rol</option>
                    @foreach($roles as $rol)

                        <option value="{{ $rol->id_rol }}"
                            {{ $usuario->getRoles->isEmpty() || $rol->nombre_rol != $rolesUsuario->nombre_rol ? "" : "selected" }}>
                            {{ $rol->nombre_rol }}</option>
                    @endforeach

                </select>
            </div>
            {{-- <div id="caja_permisos">
                <label for="permisos" class="col-form-label">{{ __('Seleccione Permisos') }}</label>
                <div id="permisos">

                </div>

            </div>

            @if($usuario->getPermisos->isNotEmpty())
                <div id="usuario_caja_permisos">
                    <label for="permisos"
                        class="col-form-label">{{ __('Seleccione Permisos') }}</label>
                    <div id="usuario_permisos">
                        @foreach($permisosRol as $permiso)
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <input id="{{ $permiso->slug_permiso }}" class="marcadoCheckbox mx-2"
                                        type="checkbox" value="{{ $permiso->id_permiso }}" name="listadoPermisos[]"
                                        {{ in_array($permiso->id_permiso, $permisosUsuario->pluck('id_permiso')->toArray()) ? 'checked="checked"' : '' }}>
                                    <label for="{{ $permiso->slug_permiso }}"
                                        class="col-form-label">{{ $permiso->nombre_permiso }}</label>
                                </div>
                            </div>

                        @endforeach

                    </div>
                </div>
                @else
                @if(isset($permisosRol))
                <div id="usuario_caja_permisos">
                    <label for="permisos"
                        class="col-form-label">{{ __('Seleccione Permisos') }}</label>
                    <div id="usuario_permisos">
                        @foreach($permisosRol as $permiso)
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <input id="{{ $permiso->slug_permiso }}" class="marcadoCheckbox mx-2"
                                        type="checkbox" value="{{ $permiso->id_permiso }}" name="listadoPermisos[]">
                                    <label for="{{ $permiso->slug_permiso }}"
                                        class="col-form-label">{{ $permiso->nombre_permiso }}</label>
                                </div>
                            </div>

                        @endforeach

                    </div>
                </div>
                @endif
            @endif --}}
            <button type="submit" class="btn btn-panel m-1">Cargar Rol</button>
            <a href="{{ route('usuario.index') }}" class="btn btn-secondary m-1">Volver Atras</a>
    </div>
    
</div>
</form>

@endsection
@section('zona_js')
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $(document).ready(function () {


        var caja_permisos = $('#caja_permisos');
        var permisos = $('#permisos');
        var usuario_caja_permisos = $('#usuario_caja_permisos');
        var usuario_permisos = $('#usuario_permisos');

        caja_permisos.hide(); //oculta divs caja_permisos y permisos

        $('#rol').on('change', function () {
            var rol_id = $(this).find(':selected').val();

            //console.log(rol_id);
            permisos.empty();
            usuario_caja_permisos.empty();
            //console.log(rol_id);
            $.ajax({
                url: "{{ route('usuario.rolpermisos',[$usuario->id_usuario]) }}",
                type: 'get',
                dataType: 'json',
                data: {
                    rol_id: rol_id,
                }
            }).done(function (data) {
                //console.log(data);
                caja_permisos.show();

                $.each(data, function (index, element) {
                    //console.log(element);
                    $(permisos).append(
                        '<div class="input-group-prepend">' +
                        '<div class="input-group-text">' +
                        '<input id="' + element.slug_permiso +
                        '" class="marcadoCheckbox mx-2" type="checkbox" value="' +
                        element.id_permiso + '" name="listadoPermisos[]"' + element
                        .check + '>' +
                        '<label for="' + element.slug_permiso +
                        '" class="col-form-label"> ' + element.nombre_permiso +
                        '</label>' +
                        '</div>' +
                        '</div>'
                    );
                });
            });
        });

    });

</script>
@endsection
