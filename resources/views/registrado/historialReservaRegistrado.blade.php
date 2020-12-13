@extends('welcome')
@section('titulo', 'Farmacias')

@section('contenido')
<div class="container">
    <div class="row shadow">
            <div class="col-12 bg-encabezado mb-3 p-2">
                <h2 class="text-center text-white"> MIS RESERVAS</h2>
                <p class="text-white text-center">Historial de reservas realizadas</p>
            </div>

        <div class="col-12 bg-white table-responsive">
            
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Número Reserva</th>
                        <th>Sucursal</th>
                        <th>Estado</th>
                        <th>Información</th>
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

