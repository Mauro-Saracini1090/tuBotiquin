@extends('admin.administrador')
@section('datos')
<h3>Informacion de Rol {{ $role->nombre_rol }}</h3>
<table class="table table-dark">
    <thead>
        <tr>
            <th scope="col">#ID</th>
            <th scope="col">Nombre de Rol</th>
            <th scope="col">Slug de Rol</th>
            <th>Permisos</th>
            <th scope="col">Fecha Creacion</th>
            <th scope="col">Ultima Modificacion</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <th scope="row">{{ $role->id_rol }}</th>
            <td>{{ $role->nombre_rol }}</td>
            <td>{{ $role->slug_rol }}</td>
            <td>Permisos</td>
            <td>{{ $role->created_at }}</td>
            <td>{{ $role->updated_at }}</td>
        </tr>
    </tbody>
</table>
<h4 style="color: white">Asignar Permisos para el Rol: {{ $role->nombre_rol }}</h4>
<form action="{{ route('roles.update',[$role->id_rol]) }}" method="post">
    @csrf
    @method('PATCH')
    <ul class="list-group">
        @forelse($permisos as $perm)
            <li class="list-group-item">
                <div class="input-group-prepend">
                    <div class="input-group-text">
                        <input class="marcadoCheckbox" type="checkbox" value="{{ $perm->id_permiso }}" name="listadoPermisos[]" aria-label="Checkbox for following text input" @if(!($role->getPermisos->isEmpty())) @foreach($role->getPermisos as $item) @if($perm->id_permiso == $item->id_permiso) checked @endif @endforeach @endif>
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
    <button type="submit" class="btn btn-panel m-1">Actualizar Permisos</button>
    <a href="{{ route('roles.index') }}" class="btn btn-secondary m-1">Volver Atras</a>
</form>

@endsection
