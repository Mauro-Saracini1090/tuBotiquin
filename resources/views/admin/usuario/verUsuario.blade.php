@extends('admin.administrador')
@section('datos')
<h3>Informacion de Usuario {{ $usuario->nombre }} {{ $usuario->apellido }}</h3>

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

<a href="{{ route('usuario.index') }}" class="btn btn-primary">Volver Atras</a>
@endsection
