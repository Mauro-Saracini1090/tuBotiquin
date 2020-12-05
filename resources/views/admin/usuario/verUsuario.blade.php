@extends('admin.administrador')
@section('datos')
<h3>Informacion de Usuario {{ $usuario->nombre }} {{ $usuario->apellido }}</h3>
<h5>El Usuario se encuentra: @if ($usuario->habilitado == 1)
    Habilitado
@else
    Deshabilitado
@endif </h5>

@if($usuario->habilitado == 0)
<span class="align-bottom">
    <a class="btn btn-panel my-1" href="#" data-toggle="modal" data-target="#habilitacion" data-habi="1">
        Habilitar Usuario
    </a>
</span>
@endif
<span class="align-bottom">
    <a class="btn btn-panel btn-danger bg-danger  my-1" href="#" data-toggle="modal" data-target="#habilitacion" data-habi="0">
        Dehabilitar Usuario
    </a>
</span>
           

<table class="table table-dark">
    <tbody>
        <tr>
            <th scope="col" style="width: 27%">#ID</th>
            <th scope="row">{{ $usuario->id_usuario }}</th>
        </tr>
        <tr>
            <th scope="col">Nombre</th>
            <td>{{ $usuario->nombre }}</td>
        </tr>
        <tr>
            <th scope="col">Apellido</th>
            <td>{{ $usuario->apellido }}</td>
        </tr>
        <tr>
            <th scope="col">Nombre de Usuario</th>
            <td>{{ $usuario->nombre_usuario }}</td>
        </tr>
        <tr>
            <th scope="col">Email</th>
            <td>{{ $usuario->email }}</td>
        </tr>
        <tr>
            <th scope="col">Localidad</th>
            <td>{{ $usuario->localidad->nombre_localidad }}
                {{ '(CP: '.$usuario->localidad->codigo_postal.')' }}
            </td>
        </tr>
        @isset($usuario->dni)
            <tr>
                <th scope="col">DNI</th>
                <td>{{ $usuario->dni }}</td>
            </tr>
        @endisset
        @isset($usuario->cuil)
            <tr>
                <th scope="col">CUIL</th>
                <td>{{ $usuario->cuil }}</td>
            </tr>
        @endisset
        @isset($usuario->cuit)
            <tr>
                <th scope="col">CUIT</th>
                <td>{{ $usuario->cuit }}</td>
            </tr>
        @endisset
        @isset($usuario->numero_matricula)
            <tr>
                <th scope="col">Matricula</th>
                <td>{{ $usuario->numero_matricula }}</td>
            </tr>
        @endisset
        <tr>
            <th scope="col">Fecha Creacion</th>
            <td>{{ $usuario->created_at }}</td>
        </tr>
        <tr>
            <th scope="col">Ultima Modificacion</th>
            <td>{{ $usuario->updated_at }}</td>
        </tr>
        <tr>
            <th scope="col">Roles:</th>
            <td>
                @if($usuario->getRoles->isNotEmpty())
                    @foreach($usuario->getRoles as $rol)
                    <span class="badge badge-pill badge-success">{{ $rol->nombre_rol }}</span>
                    @endforeach

                @endif
            </td>
            </td>
        </tr>
        <tr>
            <th scope="col">Permisos</th>
            <td>
                @if($usuario->getRoles->isNotEmpty())
                    @foreach($usuario->getRoles as $rol)
                        @if($rol->getPermisos->isNotEmpty())
                            @foreach($rol->getPermisos as $permiso)
                                <span class="badge badge-pill badge-success">{{ $permiso->nombre_permiso }}</span>
                            @endforeach

                        @endif
                    @endforeach

                @endif
                {{-- @if ($usuario->getPermisos->isNotEmpty())
                @foreach($usuario->getPermisos as $permiso)
                    {{ $rol->nombre_permiso }}
                @endforeach

                @endif--}}
            </td>
        </tr>

    </tbody>
</table>
<a href="{{ route('usuario.index') }}" class="btn btn-secondary">Volver Atras</a>
<div class="modal fade" id="habilitacion" tabindex="-1" aria-labelledby="habModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="habModalLabel"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-footer">
                <form method="POST" action="{{ route('solicitudUsuario') }}">
                    @csrf
                    <input type="hidden" id="estado_habilitacion" name="estado_habilitacion" value="">
                    <input type="hidden" id="usuario" name="usuario" value="{{ $usuario->id_usuario  }}">
                    <button type="submit" class="btn btn-panel">Si</button>
                </form>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
            </div>
        </div>
    </div>
</div>
@endsection
@section('zona_js')
    <script>
        $('#habilitacion').on('show.bs.modal', function (event) {
            var boton = $(event.relatedTarget);
            var habi = boton.data('habi');
            $('#estado_habilitacion').val(habi);
            if (habi == 1) {
                $('#habModalLabel').text('Esta seguro que desea Habilitar este Usuario?')
            } else {
                $('#habModalLabel').text('Esta seguro que desea Rechazar la solicitud de este Usuario?')
            }
            var modal = $(this);
            //modal.find('.modal-footer #id_rol').val(id_rol);
            //revisar o buscar otra forma
            // modal.find('form').attr('action',
            //     'solicitudFarmacia/');
        });

    </script>
@endsection
