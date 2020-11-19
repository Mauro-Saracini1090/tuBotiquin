@extends('admin.administrador')

@section('datos')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-2 border-bottom">
    <h1 class="h2">Lista de Obras Sociales</h1>
</div>
<a href="{{ route('obrasocial.create') }}" class="btn btn-panel float-right my-2">Cargar nueva Obra Social</a>
<table class="table table-dark">
    <thead>
        <tr>
            <th scope="col">Nombre Obra Social</th>
            <th scope="col">Telefono obra Social</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>

        @foreach($arrayObraSocial as $obraSocial)
            <tr>
                <td>{{ $obraSocial->Nombre_obra_social }}</td>
                <td>{{ $obraSocial->Telefono_obra_Social }}</td>
                <td>
                    <a class="btn btn-panel" href="{{ route('obrasocial.edit', [$obraSocial->id_obra_social ]) }}">Editar</a>
                    <a class="btn btn-panel" href="#" data-toggle="modal" data-target="#deleteModal" data-obraid="{{ $obraSocial->id_obra_social  }}">
                        Borrar
                    </a>
                </td>
            </tr>
        @endforeach
    </tbody>
   
</table>
<!-- Pagination for 6 elements -->
<div class="d-flex d-flex justify-content-center mt-4"> 
    {{ $arrayObraSocial->links() }}
</div>

<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModalLabel">Esta seguro que desea borrar esta Obra Social?</h5>
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
            var id_obra_social = boton.data('obraid');

            var modal = $(this);
            //modal.find('.modal-footer #id_rol').val(id_rol);
            //revisar o buscar otra forma
            modal.find('form').attr('action',
                'obrasocial/'+id_obra_social);
        });

    </script>
@endsection



