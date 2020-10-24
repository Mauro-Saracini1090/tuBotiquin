@extends('welcome')
@section('datos')
<h3 style="color: white">Lista de Usuarios</h3>
<a href="{{ route('usuario.create') }}" class="btn btn-primary float-right my-2">Crear Nuevo Usuario</a>
<table class="table table-dark">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Nombre</th>
            <th scope="col">Apellido</th>
            <th scope="col">Nombre de Usuario</th>
            <th scope="col">Email</th>
            <th scope="col">Acciones</th>
        </tr>
    </thead>
    <tbody>

        @foreach($usuarios as $usuario)
            <tr>
                <th scope="row">{{ $usuario->id_usuario }}</th>
                <td>{{ $usuario->nombre }}</td>
                <td>{{ $usuario->apellido }}</td>
                <td>{{ $usuario->nombre_usuario }}</td>
                <td>{{ $usuario->email }}</td>
                <td>
                    <a href="{{ route('usuario.show', [ $usuario->id_usuario]) }}">Ver</a>
                    <a href="{{ route('usuario.edit', [ $usuario->id_usuario]) }}">Editar</a>
                    <a href="#" data-toggle="modal" data-target="#deleteModal" data-roleid="{{ $usuario->id_usuario }}">
                        Borrar
                    </a>
                    <a class="btn btn-primary" href="{{ route('usuario.rolpermisos', [ $usuario->id_usuario]) }}">Asignar Rol y Permisos</a>
                </td>
            </tr>
        @endforeach


    </tbody>
</table>
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

                    <button type="submit" class="btn btn-primary">Si</button>
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
