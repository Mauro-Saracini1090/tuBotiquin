@extends('welcome')
@section('titulo', 'Farmacias')

@section('contenido')
<!-- Section of  alert mail contac send -->
@if(session()->has('borrado'))
    <div class="container">
        <div class="row">
            <div class="col-12 mx-auto">
                <div class="text-left alert alert-success alert-dismissible fade show" role="alert">
                    <p class="font-weight-bold">{{ session()->get('borrado') }}</p>
                    <strong>
                        <p class="text-right">Equipo TuBotiquín</p>
                    </strong>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            </div>
        </div>
    </div>
@endif
<!-- Section of  alert mail contac send -->
@if(session()->has('solicitudReserva'))
    <div class="container">
        <div class="row">
            <div class="col-12 mx-auto">
                <div class="text-left alert alert-success alert-dismissible fade show" role="alert">
                    <p class="font-weight-bold">{{ session()->get('solicitudReserva') }}</p>
                    <strong>
                        <p class="text-right">Equipo TuBotiquín</p>
                    </strong>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            </div>
        </div>
    </div>
@endif
@can('esRegistrado')
    <!-- Section of  Cancelar Reserva -->
    @if(session()->has('cancelar'))
        <div class="container">
            <div class="row">
                <div class="col-12 mx-auto">
                    <div class="text-left alert alert-warning alert-dismissible fade show" role="alert">
                        <p class="font-weight-bold">{{ session()->get('cancelar') }}</p>
                        <strong>
                            <p class="text-right">Equipo TuBotiquín</p>
                        </strong>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    @endif
@endcan
<div class="container">
    <div class="row">
        <div class="col-sm-12 bg-light">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th></th>
                        <th>Numero Reserva</th>
                        <th>Sucursal</th>
                        <th>Estado</th>
                        <th>Informacion</th>
                        <th>Fecha Solicitud</th>
                        <th>Fecha Vencimiento</th>
                        <th>Acciones</th>
                    </tr>
                    <tr>
                        <form class="form-inline d-flex d-flex justify-content-center" method="GET" action="{{ route('listado.reservas.farmaceutico') }}">
                            <th>
                                <div class="row">
                                    <button type="submit" class="btn btn-primary p-2 mx-auto mb-1"><i class="fas fa-search" aria-hidden="true" title="Buscar"></i></button>
                                    <button id="resetbusqueda" type="reset" class="btn btn-primary p-2 mx-auto"><i class="fas fa-sync" title="Limpiar Busqueda"></i></button>
                                </div>
                            </th>
                            <th>

                            </th>
                            <th>
                                <input class="col-12 p-0" id="nombreFarmacia" type="text"
                                    placeholder="Farmacia"><input id="farmacia_id" name="farmacia_id" hidden>
                            </th>
                            <th>
                                <select class="form-select" aria-label="Default select example" name="estado_id" id="estado_id">
                                    <option selected></option>
                                    @foreach ($estados as $estado)
                                    <option value="{{$estado->id_estados}}">{{$estado->descripcion_tipo_estados}}</option>

                                    @endforeach    
                                  </select>
                            </th>
                            <th></th>
                            <th>
                                <input class="col-10 p-0" id="fechasolicitud" name="solicitud_id" type="date" placeholder="Fecha Solicitud">

                            </th>
                            <th>
                                <input class="col-10 p-0" id="fechavencimiento" name="vencimiento_id" type="date" placeholder="Fecha Vencimiento">
                                </td>
                            <th>
                                </td>
                        </form>

                    </tr>
                </thead>
                <tbody>
                    @foreach($reservas as $reserva)
                        <tr>
                            <td></td>
                            <td>{{ $reserva->numero_reserva }}</td>
                            <td>{{ $reserva->getSucursal->getFarmacia->nombre_farmacia }} -
                                {{ $reserva->getSucursal->direccion_sucursal }}</td>
                            <td>{{ $reserva->getEstado->descripcion_tipo_estados }}</td>
                            <td>
                                <ul>
                                    @foreach($reserva->reservaMedicamentos as $medicamento)
                                        <li>
                                            {{ $medicamento->nombre_medicamento }} -
                                            x{{ $medicamento->pivot->cantidad }}
                                        </li>
                                    @endforeach
                                </ul>
                            </td>
                            <td>{{ $reserva->fecha_solicitud_estados }}</td>
                            <td>{{ $reserva->fecha_caducidad_estados }}</td>
                            @if($reserva->estados_id == 1)
                            <td>
                                <div class="col">
                                    <button class="btn btn-primary p-2 mx-auto mb-1" data-toggle="modal" data-target="#habilitacion" data-habi="3" data-res="{{ $reserva->id_reserva }}"><i class="fas fa-check-square" title="Aceptar Reserva"></i></button>
                                    <button class="btn btn-primary p-2 mx-auto" data-toggle="modal" data-target="#habilitacion" data-habi="2" data-res="{{ $reserva->id_reserva }}"><i class="fas fa-times-circle" title="Rechazar Reserva"></i></button>
                                </div>
                            </td>
                            @endif
                        </tr>
                    @endforeach

                </tbody>
            </table>
        </div>
    </div>
</div>
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
                <form method="POST" action="{{ route('solicitudReserva') }}">
                    @csrf
                    <input type="hidden" id="estado_habilitacion" name="estado_habilitacion" value="">
                    <input type="hidden" id="reserva" name="reserva" value="{{ $reserva->id_farmacia }}">
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
    $('#resetbusqueda').click(function(){
        history.pushState(null, "", "historialreservasFarmacia");
        location.reload();
    });
    
</script>
<script>
    $(function () {
        $('#nombreFarmacia').autocomplete({
            source: function (request, response) {
                $.getJSON('{{ route("autocomplete.reserva.farmacia") }}?term=' + request
                    .term,
                    function (data) {
                        var array = $.map(data, function (row) {
                            return {
                                value: row.nombre_farmacia,
                                label: row.nombre_farmacia,
                                name: row.id_farmacia,


                            }
                        })
                        response($.ui.autocomplete.filter(array, request.term));
                    })
            },
            minLength: 1,
            delay: 400,
            select: function (event, ui) {
                $('#farmacia_id').val(ui.item.name)
            }
        })
    })

</script>
<script>
    $('#habilitacion').on('show.bs.modal', function (event) {
        var boton = $(event.relatedTarget);
        var habi = boton.data('habi');
        var res = boton.data('res');
        $('#estado_habilitacion').val(habi);
        $('#reserva').val(res);
        if (habi == 3) {
            $('#habModalLabel').text('Esta seguro que desea Aceptar esta Reserva?')
        }
        if(habi == 2){
            $('#habModalLabel').text('Esta seguro que desea Rechazar esta Reserva?')
        }
        var modal = $(this);
    });

</script>
@endsection
