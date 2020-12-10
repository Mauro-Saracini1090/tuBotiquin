<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <h1>Tu Botiquin - Solicitud de Reserva</h1>
    <p>Usuario Solicitante: {{ $reserva->reservaUsuario->nombre }} {{ $reserva->reservaUsuario->apellido }} - {{ $reserva->reservaUsuario->email }} - {{ $reserva->reservaUsuario->telefono_movil }}</p>
    <p>Numero Reserva: {{ $reserva->numero_reserva }}</p>
    <p>Sucursal de Retiro: {{ $reserva->getSucursal->getFarmacia->nombre_farmacia }} - {{ $reserva->getSucursal->direccion_sucursal }}</p>
    <p> Lisado Productos:
        <ul>
            @foreach($reserva->reservaMedicamentos as $medicamento)
                <li>
                    {{$medicamento->nombre_medicamento}} - x{{$medicamento->pivot->cantidad}}
                </li>
            @endforeach
        </ul>
    </p>
    <p>Fecha de Solicitud: {{ $reserva->fecha_solicitud_estados }}</p>
    <p>Fecha Vencimiento Reserva:{{ $reserva->fecha_caducidad_estados }}</p>
</body>
</html>