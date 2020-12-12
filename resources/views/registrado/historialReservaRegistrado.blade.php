@extends('welcome')
@section('titulo', 'Farmacias')

@section('contenido')
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
            <div class="d-flex d-flex justify-content-center mt-4"> 
                {{ $reservas->links() }}
            </div>
        </div>
    </div>
</div>
@endsection

