@extends('admin.administrador')
@section('titulo', 'Listado Farmacias')
@section('datos')
    <div class="container-fluid">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-2 border-bottom">
            <h1 class="h2">Lista de Farmacias</h1>
        </div>
        <a href="{{ route('farmacia.create') }}" class="btn btn-panel float-right my-2">Cargar nueva Farmacia</a>
        <div class="table-responsive">
            <table class="table table-striped">
                <thead class="thead-dark">
                    <tr>
                        {{-- <th scope="col">Farmaceutico Acargo</th>
                        --}}
                        <th scope="col">Nombre Farmacia</th>
                        <th scope="col">Descripcion</th>
                        <th scope="col">Habilitada?</th>
                        <th scope="col">Borrado Logico?</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>

                    @foreach ($arrayFarmacias as $farmacias)

                        <tr>
                            {{-- <td>{{ $farmacias->usuarioFarmaceutico->nombre }}
                                {{ $farmacias->usuarioFarmaceutico->apellido }}
                            </td> --}}
                            <td>{{ $farmacias->nombre_farmacia }}</td>
                            <td><?php echo $farmacias->descripcion_farmacia ?></td>
                            <td>
                                @if ($farmacias->habilitada == 1)
                                    Habilitada
                                @else
                                    Deshabilitada
                                @endif

                            </td>
                            <td>
                                @if ($farmacias->borrado_logico_farmacia == 1)
                                    Se ha Eliminado
                                @else
                                    No Se ha Eliminado
                                @endif
                            </td>
                            <td>
                                <a class="btn btn-panel p-1 m-1" href="{{ route('farmacia.show', [$farmacias->id_farmacia]) }}">
                                    <i class="material-icons" title="Informacio">info</i>
                                </a>
                                <a class="btn btn-panel p-1 m-1" href="{{ route('farmacia.edit', [$farmacias->id_farmacia]) }}">
                                    <i class="material-icons" title="Editar">mode_edit</i>
                                </a>
                                <a class="btn btn-panel p-1 m-1" href="#" data-toggle="modal" data-target="#deleteModal" data-farmaid="{{ $farmacias->id_farmacia }}">
                                    <i class="material-icons" title="Eliminar">delete_forever</i>
                                </a>
                            </td>
                        </tr>
                    @endforeach


                </tbody>
            </table>
        </div>
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
                            {{-- <input type="hidden" id="id_rol" name="id_rol" value="">
                            --}}

                            <button type="submit" class="btn btn-panel">Si</button>
                        </form>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('zona_js')
    <script>
        $('#deleteModal').on('show.bs.modal', function(event) {
            var boton = $(event.relatedTarget);
            var id_farmacia = boton.data('farmaid');

            var modal = $(this);
            //modal.find('.modal-footer #id_rol').val(id_rol);
            //revisar o buscar otra forma
            modal.find('form').attr('action',
                'borrarFarmacia/' + id_farmacia);
        });

    </script>
@endsection
