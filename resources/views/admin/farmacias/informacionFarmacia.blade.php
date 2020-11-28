@extends('admin.administrador')
@section('datos')
<div class="row mt-2">
    <div class="col align-bottom">
        <span class="align-bottom">
            <h3 class="">Informacion de Farmacia {{ $farmacium->nombre_farmacia }}</h3>
        </span>
        @if($farmacium->borrado_logico_farmacia == 0 )
            @if($farmacium->habilitada == 0)
                <span class="align-bottom">
                    <a class="btn btn-panel my-1" href="#" data-toggle="modal" data-target="#habilitacion"
                        data-habi="1">
                        Aceptar Farmacia
                    </a>
                </span>
            @endif
                <span class="align-bottom">
                    <a class="btn btn-panel btn-danger bg-danger  my-1" href="#" data-toggle="modal"
                        data-target="#habilitacion" data-habi="0">
                        Rechazar Farmacia
                    </a>
                </span>
            
        @endif
    </div>
</div>
<table class="table table-dark">
    <tbody>
        <tr>
            <th scope="col" style="width: 27%">#ID</th>
            <th scope="row">{{ $farmacium->id_farmacia }}</th>
        </tr>
        <tr>
            <th scope="col">Farmaceutico Acargo</th>
            <td>{{ $farmacium->usuarioFarmaceutico->nombre }} {{ $farmacium->usuarioFarmaceutico->apellido }}
            </td>
        </tr>
        <tr>
            <th scope="col">Nombre Farmacia</th>
            <td>{{ $farmacium->nombre_farmacia }}</td>
        </tr>
        <tr>
            <th scope="col">Descripcion de Farmacia</th>
            <td>{{ $farmacium->descripcion_farmacia }}</td>
        </tr>
        <tr>
            <th scope="col">Cuit</th>
            <td>{{ $farmacium->cuit }}</td>
        </tr>
        <tr>
            <th scope="col">Logo Farmacia</th>
            <td><img class="img-thumbnail rounded float-left"
                    src="{{ URL::to('/') }}{{ $farmacium->img_farmacia }}"
                    alt="{{ $farmacium->nombre_farmacia }}" width="200px"></td>
        </tr>
        <tr>
            <th scope="col">Estado Farmacias</th>
            @if($farmacium->habilitada == 1)
                <td>
                    Farmacia Habilitada
                </td>
            @else
                <td>
                    Farmacia Deshabilitada
                </td>
            @endif
        </tr>
        <tr>
            <th scope="col">Estado Borrado Logico</th>
            @if($farmacium->borrado_logico_farmacia == 1)
                <td>
                    Se Realizado un Borrado Logico
                </td>
            @else
                <td>
                    No Se ha Realizado un Borrado Logico
                </td>
            @endif
        </tr>
        <tr>
            <th scope="col">Fecha Creacion</th>
            <td>{{ $farmacium->created_at }}</td>
        </tr>
        <tr>
            <th scope="col">Ultima Actualizacion</th>
            <td>{{ $farmacium->updated_at }}</td>
        </tr>
    </tbody>
</table>
<a href="{{ route('farmacia.index') }}" class="btn btn-secondary">Volver Atras</a>

<div class="modal fade" id="habilitacion" tabindex="-1" aria-labelledby="habModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="habModalLabel">Esta seguro que desea borrar esta Farmacia?</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-footer">
                <form method="POST" action="{{ route('solicitudFarmacia') }}">
                    @csrf
                    <input type="hidden" id="estado_habilitacion" name="estado_habilitacion" value="">
                    <input type="hidden" id="farmacia" name="farmacia" value="{{ $farmacium->id_farmacia }}">
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
    $('#habilitacion').on('show.bs.modal', function (event) {
        var boton = $(event.relatedTarget);
        var habi = boton.data('habi');
        $('#estado_habilitacion').val(habi);
        if (habi == 1) {
            $('#habModalLabel').text('Esta seguro que desea Habilitar esta Farmacia?')
        } else {
            $('#habModalLabel').text('Esta seguro que desea Rechazar la solicitud de esta Farmacia?')
        }
        var modal = $(this);
        //modal.find('.modal-footer #id_rol').val(id_rol);
        //revisar o buscar otra forma
        // modal.find('form').attr('action',
        //     'solicitudFarmacia/');
    });

</script>
@endsection
