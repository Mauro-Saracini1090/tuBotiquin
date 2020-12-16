@extends('admin.administrador')
@section('datos')
<h3 >Lista de Usuarios</h3>
<a href="{{ route('usuario.create') }}" class="btn btn-panel float-right my-2">Crear Nuevo Usuario</a>
<div class="table-responsive">
    <table class="table table-striped">
        <thead class="thead-dark">
        <tr>
            <th scope="col">#</th>
            <th scope="col">Nombre</th>
            <th scope="col">Apellido</th>
            {{-- <th scope="col">Nombre de Usuario</th> --}}
            <th scope="col">Email</th>
            <th scope="col">Rol</th>
            <th scope="col">Estado</th>
            <th scope="col">Acciones</th>
        </tr>
    </thead>
    <tbody>

        @foreach($usuarios as $usuario)
            <tr>
                <th scope="row">{{ $usuario->id_usuario }}</th>
                <td>{{ $usuario->nombre }}</td>
                <td>{{ $usuario->apellido }}</td>
                {{-- <td>{{ $usuario->nombre_usuario }}</td> --}}
                <td>{{ $usuario->email }}</td>
                <td>
                    @if($usuario->getRoles->isNotEmpty())
                        @foreach($usuario->getRoles as $rol)
                            <span class="badge badge-pill badge-success">{{ $rol->nombre_rol }}</span>
                        @endforeach

                    @endif
                </td>
                <td>
                    @if($usuario->habilitado == 0)
                        Deshabilitado
                    @else
                        Habilitado
                    @endif
                </td>
                <td>
                    <a class="btn btn-panel p-1 m-1" href="{{ route('usuario.show', [ $usuario->id_usuario]) }}">
                        <i class="material-icons" title="Informacio">info</i>
                    </a>
                    <a class="btn btn-panel p-1 m-1" href="{{ route('usuario.edit', [ $usuario->id_usuario]) }}">
                        <i class="material-icons" title="Editar">mode_edit</i>
                    </a>
                    <a class="btn btn-panel p-1 m-1" href="#" data-toggle="modal" data-target="#deleteModal" data-roleid="{{ $usuario->id_usuario }}">
                        <i class="material-icons" title="Eliminar">delete_forever</i>
                        
                    </a>
                    <a class="btn btn-panel p-1 m-1" href="{{ route('usuario.rolpermisos', [ $usuario->id_usuario]) }}">
                        <i class="material-icons" title="Asignar un Rol">work</i>
                    </a>
                </td>
            </tr>
        @endforeach


    </tbody>
</table>
<div class="d-flex d-flex justify-content-center mt-4">
    {{ $usuarios->links() }}
</div>
</div>
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModalLabel">Esta seguro que desea borrar este Usuario?</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-footer">
                <form method="POST" action="">
                    @method('DELETE' )
                    @csrf
                    {{-- <input type="hidden" id="id_rol" name="id_rol" value=""> --}}

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
    $('#deleteModal').on('show.bs.modal', function (event) {
        var boton = $(event.relatedTarget);
        var id_usuario = boton.data('roleid');

        var modal = $(this);
        //modal.find('.modal-footer #id_rol').val(id_rol);
        //revisar o buscar otra forma
        modal.find('form').attr('action', 'usuario/' + id_usuario);
    });

</script>
@endsection
