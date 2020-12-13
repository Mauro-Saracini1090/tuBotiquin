@extends('admin.administrador')

@section('datos')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-2 border-bottom">
    <h1 class="h2">Lista de Localidades</h1>
</div>
<a href="{{ route('localidad.create') }}" class="btn btn-panel float-right my-2">Cargar nueva localidad</a>
<table class="table table-striped">
    <thead class="thead-dark">
        <tr>
            <th scope="col">Nombre Localidad</th>
            <th scope="col">Código Postal</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>

        @foreach($localidades as $localidad)
            <tr>
                <td>{{ $localidad->nombre_localidad }}</td>
                <td>{{ $localidad->codigo_postal }}</td>
                <td>
                    <a class="btn btn-panel p-1 m-1" href="{{ route('localidad.edit', [$localidad->codigo_postal]) }}">
                        <i class="material-icons" title="Editar">mode_edit</i>
                    </a>
                    <a class="btn btn-panel p-1 m-1" href="#" data-toggle="modal" data-target="#deleteModal" data-roleid="{{ $localidad->codigo_postal }}">
                        <i class="material-icons" title="Eliminar">delete_forever</i>
                    </a>
                </td>
            </tr>
        @endforeach


    </tbody>
</table>
<div class="d-flex d-flex justify-content-center mt-4"> 
    {{ $localidades->links() }}
</div>
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModalLabel">Esta seguro que desea borrar este localidad?</h5>
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
            var codigo_postal = boton.data('roleid');

            var modal = $(this);
            //modal.find('.modal-footer #id_rol').val(id_rol);
            //revisar o buscar otra forma
            modal.find('form').attr('action',
                'localidad/'+codigo_postal);
        });

    </script>
@endsection



