<!DOCTYPE html>
<html lang="en">
<head>
    <title></title>
</head>
<body>
        <div>
            <div class="card col-8 mx-auto">
                <div class="card-body">
                    <h1>Nuevo mensaje de contacto Farmaceutico</h1>
                    <p>Recibiste un mensaje de:<strong> {{ $msjContacto['email'] }} </strong> - matricula: <strong> {{ $msjContacto['numero_matricula'] }} </strong> </p>
                    <p>Asunto: <strong>{{ $msjContacto['motivo'] }} </strong></p>
                    <p>Consulta: <strong>{{ $msjContacto['consulta'] }}</strong></p>
                </div>
            </div>
        </div>
</body>
</html>

