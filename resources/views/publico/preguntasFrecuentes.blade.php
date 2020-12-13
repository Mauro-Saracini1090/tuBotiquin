@extends('welcome')
@section('titulo','Home')

@section('contenido')
    <div class="container">
        <h2 class="page-section-heading text-center text-uppercase text-secondary mb-5">Preguntas Frecuentes</h2>
        <div class="row">
            <div class="col-lg-4 col-12">
            <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                <a class="nav-link active" id="v-pills-home-tab" data-toggle="pill" href="#v-pills-home" role="tab" aria-controls="v-pills-home" aria-selected="true"><p class="lead text-center">¿Qué hace la plataforma?</p></a>
                <a class="nav-link" id="v-pills-profile-tab" data-toggle="pill" href="#v-pills-profile" role="tab" aria-controls="v-pills-profile" aria-selected="false"><p class="lead text-center">¿Cómo me registro?</p></a>
                <a class="nav-link" id="v-pills-messages-tab" data-toggle="pill" href="#v-pills-messages" role="tab" aria-controls="v-pills-messages" aria-selected="false"><p class="lead text-center">¿Cómo reservo un medicamento?</p></a>
                <a class="nav-link" id="v-pills-settings-tab" data-toggle="pill" href="#v-pills-settings" role="tab" aria-controls="v-pills-settings" aria-selected="false"><p class="lead text-center">¿Puedo dar de baja mi usuario?</p></a>
                <a class="nav-link" id="v-pills-settings-tab" data-toggle="pill" href="#v-pills-settings2" role="tab" aria-controls="v-pills-settings" aria-selected="false"><p class="lead text-center">¿Puedo contactarme con el admnistrador del sitio?</p></a>
            </div>
            </div>
            <div class="col-lg-8 col-12">
            <div class="tab-content" id="v-pills-tabContent">
                <div class="tab-pane fade show active shadow px-3 py-3" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab">
                    <p class="lead text-left">
                     La plataforma tiene dos funciones principales, mostrar las farmacias que se encuentran de turno el día de hoy como también de los próximos
                     días de la semana y hacer la resevar de uno o más medicamentos.  
                    </p>
                </div>
                <div class="tab-pane fade shadow px-3 py-3" id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab">
                    <p class="lead text-left"> 
                       Para registrarse deberá completar con sus datos personales el formulario de registro, puede hacerlo haciendo clic <a href="{{route('register')}}" target="_blank">aca</a> y podrá comenzar a utilizar las funciones de la plataforma.      
                    </p>
                    <p class="lead text-left"> 
                        Si desea tener un perfil <strong>Farmaceutico</strong>, deberá completar con los datos de su sucursal farmacuetica, puede acceder al mismo desde <a href="{{route('farmaceutico')}}" target="_blank">aca</a>.
                        Estos datos serán evaluados por el Admnistrador para verificar la vericidad de los mismos. 
                        Una vez aprobado, le llegará un correo con la confirmación y prodrá comenzar a utilizar la plataforma.  
                    </p>    
                </div>
                <div class="tab-pane fade shadow px-3 py-3" id="v-pills-messages" role="tabpanel" aria-labelledby="v-pills-messages-tab">
                    <p class="lead text-left"> 
                        Para poder reservar uno o mas medicamentos, primero deberá estar regristrado. 
                        Luego en el botón Farmacias del menú, podrá elegir su farmacia preferida y verá el botón con el logotipo de pildoras, haciendo clic en el
                        mismo verá todo un listado de medicamentos.   
                    </p>
                    <p class="lead text-left">
                        Podrá reservar un máximo de 5 unidades de cada medicamento y para finalizar la reserva deberá ir al icono de "carrito" que aparecerá en la parte superior 
                        y deberá elegir la sucursal por la que pasará a retirar el pedido. 
                    </p>
                    <p class="lead text-left">
                        Finalemente le llegará un correo electrónico notificandole si su pedido fue aceptado y cuando esta disponible para su retiro. 
                    </p>   
                </div>
                <div class="tab-pane fade shadow px-3 py-3" id="v-pills-settings" role="tabpanel" aria-labelledby="v-pills-settings-tab">
                    <p class="lead text-left">    
                        Si, podrá eliminar su cuenta de usuario yendo a  "Mi perfil" desde el botón con el logotipo de "tacho de basurra".
                    </p>    
                </div>
                <div class="tab-pane fade shadow px-3 py-3" id="v-pills-settings2" role="tabpanel" aria-labelledby="v-pills-settings-tab">
                    <p class="lead text-left">    
                       Por supuesto que si, en el menú principal esta el botón "Contacto" y desde ahi podrá evacuar todas sus inquietudes.
                    </p>    
                </div>
            </div>
            </div>
        </div>
    </div>    
@endsection        