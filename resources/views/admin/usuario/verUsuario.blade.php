@extends('welcome')
@section('datos')
<h3 style="color: white">Informacion de Usuario {{ $usuario->nombre }} {{ $usuario->apellido }}</h3>
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

    </tbody>
</table>
{{--  
<h4 style="color: white">Asignar Permisos para el Rol: {{ $role->nombre_rol }}</h4>
<form action="{{ route('roles.update',[$role->id_rol]) }}" method="post">
    @csrf
    @method('PATCH')
    <ul class="list-group">
        @forelse($permisos as $perm)
            <li class="list-group-item">
                <div class="input-group-prepend">
                    <div class="input-group-text">
                        <input class="marcadoCheckbox" type="checkbox" value="{{ $perm->id_permiso }}"
                            name="listadoPermisos[]" aria-label="Checkbox for following text input" <blade
                            if|(!(%24role-%3EgetPermisos-%3EisEmpty()))%20%40foreach(%24role-%3EgetPermisos%20as%20%24item)%0D>
                        <blade
                            if|(%24perm-%3Eid_permiso%20%3D%3D%20%24item-%3Eid_permiso)%20checked%20%40endif%20%40endforeach%20%40endif%3E%0D>
                    </div>
                    <span class="input-group-text">
                        {{ $perm->nombre_permiso }}
                    </span>
                </div>
            </li>
        @empty
            <li class="list-group-item">No hay Permisos Registrados</li>
        @endforelse
    </ul>
    <button type="submit" class="btn btn-primary">Añadir Permisos</button>
</form>--}}
<a href="{{ route('usuario.index') }}" class="btn btn-primary">Volver Atras</a>
@endsection
