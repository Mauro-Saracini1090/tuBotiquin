@extends('admin.administrador')
@section('datos')
<h3>Lista de Roles</h3>
<a href="{{ route('roles.create') }}" class="btn btn-panel float-right my-2">Crear Nuevo ROL</a>
<table class="table table-dark">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Nombre de Rol</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>

        @foreach($roles as $rol)
            <tr>
                <th scope="row">{{ $rol->id_rol }}</th>
                <td>{{ $rol->nombre_rol }}</td>
                <td>
                    {{-- <a class="btn btn-panel" href="{{ route('roles.show', [$rol->id_rol]) }}">Asignar Permisos</a> --}}
                   {{-- <a class="btn btn-panel" href="{{ route('roles.edit', [$rol->id_rol]) }}">Editar</a>  --}}
                    <a class="btn btn-panel" href="#" data-toggle="modal" data-target="#deleteModal" data-roleid="{{ $rol->id_rol }}">
                        Borrar
                    </a>
                </td>
            </tr>
        @endforeach


    </tbody>
</table>
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModalLabel">Esta seguro que desea borrar este Rol?</h5>
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
        var id_rol = boton.data('roleid');

        var modal = $(this);
        //modal.find('.modal-footer #id_rol').val(id_rol);
        //revisar o buscar otra forma
        modal.find('form').attr('action',
            'roles/'+id_rol);
    });

</script>
@endsection
