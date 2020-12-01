@extends('admin.administrador')
@section('titulo', 'Listado Farmacias')
@section('datos')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-2 border-bottom">
    <h1 class="h2">Lista de Farmacias</h1>
</div>
<a href="{{ route('farmacia.create') }}" class="btn btn-panel float-right my-2">Cargar nueva Farmacia</a>
<table class="table table-dark">
    <thead>
        <tr>
            <th scope="col">Farmaceutico Acargo</th>
            <th scope="col">Nombre Farmacia</th>
            <th scope="col">Descripcion</th>
            <th scope="col">Habilitada?</th>
            <th scope="col">Borrado Logico?</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>

        @foreach($arrayFarmacias as $farmacias)
       
            <tr>
                <td>{{ $farmacias->usuarioFarmaceutico->nombre}} {{ $farmacias->usuarioFarmaceutico->apellido}}</td>
                <td>{{ $farmacias->nombre_farmacia }}</td>
                <td>{{ $farmacias->descripcion_farmacia }}</td>
                <td>{{ $farmacias->habilitada }}</td>
                <td>{{ $farmacias->borrado_logico_farmacia }}</td>
                <td>
                    <a class="btn btn-panel my-1" href="{{ route('farmacia.show', [$farmacias->id_farmacia]) }}">ver</a><br>
                    <a class="btn btn-panel my-1" href="{{ route('farmacia.edit', [$farmacias->id_farmacia]) }}">Editar</a><br>
                    <a class="btn btn-panel my-1" href="#" data-toggle="modal" data-target="#deleteModal" data-farmaid="{{ $farmacias->id_farmacia }}">
                        Borrar
                    </a>
                    <a class="btn btn-panel" href="{{ route('obrasocialfarmacia') }}">Asignar Obra Social a Farmacia</a>
                </td>
            </tr>
        @endforeach


    </tbody>
</table>
<div class="d-flex d-flex justify-content-center mt-4"> 
    {{ $arrayFarmacias->links() }}
</div>
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModalLabel">Esta seguro que desea borrar esta Farmacia?</h5>
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
            var id_farmacia = boton.data('farmaid');

            var modal = $(this);
            //modal.find('.modal-footer #id_rol').val(id_rol);
            //revisar o buscar otra forma
            modal.find('form').attr('action',
                'borrarFarmacia/'+id_farmacia);
        });

    </script>
@endsection



