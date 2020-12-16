@extends('admin.administrador')
@section('datos')
<div class="row mt-2">
    <div class="col align-bottom">
        <span class="align-bottom"><h3 class="">Informacion de Sucursal</h3></span>
            @if($sucursal->habilitado == 0)
            <span class="align-bottom">
                <a class="btn btn-panel my-1" href="#" data-toggle="modal" data-target="#habilitacion" data-habi="1">
                    Aceptar Sucursal
                </a>
            </span>
            @else
            <span class="align-bottom">
                <a class="btn btn-panel btn-danger bg-danger  my-1" href="#" data-toggle="modal" data-target="#habilitacion" data-habi="0">
                    Rechazar Sucursal
                </a>
            </span>
            @endif
    </div>
</div>
<table class="table table-dark table-striped">
    <tbody>
        <tr>
            <th scope="col" style="width: 20%">#ID</th>
            <th scope="row">{{ $sucursal->id_sucursal  }}</th>
        </tr>
        <tr>
            <th scope="col">Farmacia Acargo</th>
            <td>{{ $sucursal->getFarmacia->nombre_farmacia }}</td>
        </tr>
        <tr>
            <th scope="col">CUFE Sucursal</th>
            <td>{{ $sucursal->cufe_sucursal }}</td>
        </tr>
        <tr>
            <th scope="col">Descripcion de Sucursal</th>
            <td><?php echo $sucursal->descripcion_sucursal ?></td>
        </tr>
        <tr>
            <th scope="col">Email</th>
            <td>{{ $sucursal->email_sucursal }}</td>
        </tr>
        <tr>
            <th scope="col">Telefono Fijo:</th>
            <td>{{ $sucursal->telefono_fijo }}</td>
        </tr>
        <tr>
            <th scope="col">Telefono Movil</th>
            <td>{{ $sucursal->telefono_movil }}</td>
        </tr>
        <tr>
            <th scope="col">Direccion</th>
            <td>{{ $sucursal->direccion_sucursal }}</td>
        </tr>
        <tr>
            <th scope="col">Estado Sucursal</th>
            @if($sucursal->habilitado == 1)
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
            @if($sucursal->borrado_logico_sucursal == 1)
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
            <td>{{ $sucursal->created_at }}</td>
        </tr>
        <tr>
            <th scope="col">Ultima Actualizacion</th>
            <td>{{ $sucursal->updated_at }}</td>
        </tr>
    </tbody>
</table>
<a href="{{ route('sucursal.index') }}" class="btn btn-secondary mb-2">Volver Atras</a>
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
                <form method="POST" action="{{ route('solicitudSucursal') }}">
                    @csrf
                    <input type="hidden" id="estado_habilitacion" name="estado_habilitacion" value="">
                    <input type="hidden" id="sucursal" name="sucursal" value="{{ $sucursal->id_sucursal  }}">
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
                $('#habModalLabel').text('Esta seguro que desea Habilitar esta Sucursal?')
            } else {
                $('#habModalLabel').text('Esta seguro que desea Rechazar la solicitud de esta Sucursal?')
            }
            var modal = $(this);
            //modal.find('.modal-footer #id_rol').val(id_rol);
            //revisar o buscar otra forma
            // modal.find('form').attr('action',
            //     'solicitudFarmacia/');
        });

    </script>
@endsection