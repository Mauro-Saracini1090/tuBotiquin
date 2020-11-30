<!DOCTYPE html>
<html lang="en">


        <div>
            <div class="card col-8 mx-auto">
                <div class="card-body">
                    <h1>Nuevo mensaje de contacto</h1>
                    <p>Recibiste un mensaje de: {{ $msjContacto['email'] }} </p>
                    <p>Asunto: {{ $msjContacto['radio'] }} </p>
                    <p>Consulta: {{ $msjContacto['consulta'] }} </p>
                </div>
            </div>
        </div>



</html>

