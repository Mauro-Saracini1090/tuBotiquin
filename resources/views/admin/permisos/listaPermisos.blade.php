@extends('admin.administrador')
@section('datos')
<h3>Lista de Permisos</h3>
<a href="{{ route('permisos.create') }}" class="btn btn-panel float-right my-2">Crear Nuevo
    Permiso</a>
<table class="table table-dark">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Nombre de Permiso</th>
            <th scope="col">Slug de Permiso</th>
            <th scope="col">Fecha de Creacion</th>
            <th scope="col">Ultima Actualizacion</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>

        @foreach($permisos as $permiso)
            <tr>
                <th scope="row">{{ $permiso->id_permiso }}</th>
                <td>{{ $permiso->nombre_permiso }}</td>
                <td>{{ $permiso->slug_permiso }}</td>
                <td>{{ $permiso->created_at }}</td>
                <td>{{ $permiso->updated_at }}</td>
                <td>
                    {{-- <a href="{{ route('permisos.show', [ $permiso->id_permiso]) }}">Ver</a> --}}
                    
                    <a class="btn btn-panel" href="{{ route('permisos.edit', [ $permiso->id_permiso]) }}">Editar</a>
                    <a class="btn btn-panel" href="#" data-toggle="modal" data-target="#deleteModal"
                        data-roleid="{{ $permiso->id_permiso }}">
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
                <h5 class="modal-title" id="deleteModalLabel">Esta seguro que desea borrar este Permiso?</h5>
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
        var id_permiso = boton.data('roleid');

        var modal = $(this);
        //modal.find('.modal-footer #id_rol').val(id_rol);
        //revisar o buscar otra forma
        modal.find('form').attr('action', 'permisos/' + id_permiso);
    });

</script>
@endsection
