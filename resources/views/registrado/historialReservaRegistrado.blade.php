@extends('welcome')
@section('titulo', 'Farmacias')

@section('contenido')
<div class="container">
    <div class="row">
        <div class="col-12 mb-3 p-3">
            <h3 class="text-secondary mb-0 text-center">MIS RESERVAS</h3>      
         </div>
        <div class="col-lg-12 col-12 bg-light shadow">
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <th>Número Reserva</th>
                        <th>Sucursal</th>
                        <th>Estado</th>
                        <th>Información</th>
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
</div>
@endsection
