@extends('welcome')
@section('titulo', 'Farmacias')

@section('contenido')
<div class="container">
    <div class="row">
        <div class="col-sm-12 bg-light">
            <table class="table table-striped">
                <thead>
                    <th>Numero Reserva</th>
                    <th>Sucursal</th>
                    <th>Estado</th>
                    <th>Informacion</th>
                    <th>Fecha Solicitud</th>
                    <th>Fecha Vencimiento</th>
                </thead>
                <tbody>
                    @foreach($reservas as $reserva)
                        <tr>
                            <td>{{ $reserva->numero_reserva }}</td>
                            <td>{{ $reserva->getSucursal->getFarmacia->nombre_farmacia }} -
                                {{ $reserva->getSucursal->direccion_sucursal }}</td>
                            <td>{{ $reserva->getEstado->descripcion_tipo_estados }}</td>
                            <td>
                                <ul>
                                    @foreach($reserva->reservaMedicamentos as $medicamento)
                                        <li>
                                            {{$medicamento->nombre_medicamento}} - x{{$medicamento->pivot->cantidad}}
                                        </li>
                                    @endforeach
                                </ul>
                            </td>
                            <td>{{ $reserva->fecha_solicitud_estados }}</td>
                            <td>{{ $reserva->fecha_caducidad_estados }}</td>
                        </tr>
                    @endforeach

                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
