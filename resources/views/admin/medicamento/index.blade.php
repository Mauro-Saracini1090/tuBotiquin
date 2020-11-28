@extends('admin.administrador')

@section('datos')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-2 border-bottom">
    <h1 class="h2">Lista de Medicamentos</h1>
</div>
<a href="{{ route('medicamentos.create') }}" class="btn btn-panel float-right my-2">Cargar nuevo Medicamento</a>
<table class="table table-dark">
    <thead>
        <tr>
            <th scope="col">Nombre Medicamento</th>
            <th scope="col">Tipo Medicamento</th>
            <th scope="col">Marca Medicamento</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>

        @foreach($medicamentos as $medicamento)
            <tr>
                <td>{{ $medicamento->nombre_medicamento }}</td>
                <td>{{ $medicamento->getTipo->nombre_tipo }}</td>
                <td>{{ $medicamento->getMarca->nombre_marca }}</td>
                <td>
                    <a class="btn btn-panel my-1" href="{{ route('medicamentos.show', [$medicamento->id_medicamento]) }}">ver</a><br>
                    <a class="btn btn-panel" href="{{ route('medicamentos.edit', [$medicamento])}}">Editar</a>
                    <a class="btn btn-panel" href="#" data-toggle="modal" data-target="#deleteModal" data-medid="{{ $medicamento->id_medicamento }}">
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
                <h5 class="modal-title" id="deleteModalLabel">Esta seguro que desea borrar este Medicamento?</h5>
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
            var id_medicamento = boton.data('medid');

            var modal = $(this);
            //modal.find('.modal-footer #id_rol').val(id_rol);
            //revisar o buscar otra forma
            modal.find('form').attr('action',
                'medicamentos/'+id_medicamento);
        });

    </script>
@endsection



