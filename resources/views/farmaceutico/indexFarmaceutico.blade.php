@extends('welcome')
@section('titulo','Home Farmaceutico')

@section('contenido')
<!--<div class="shadow p-3 mb-5 bg-white rounded">  -->
<div class="py-2 pb-5">
    <div class="container">

        <div class="row">
            <div class="col-12">

            </div>
            <div class="col-md-3 col-12">
                @can('esFarmaceutico')

                    <ul class="list-group list-group-flush">
                        {{-- <li class="list-group-item "><h6 class="masthead-subheading">FARMACIA</h6>
                                <div class="d-flex d-flex justify-content-left pb-2 ml-3">                             
                                  <a href="{{ route('farmacia.create') }}"> <i
                            class=" Medium material-icons " style="font-size: 40px" data-toggle="tooltip"
                            data-placement="left" title="Agregar nueva Farmacia">add_box</i></a>
                        <a href="{{ route('verfarmacia') }}"><i class="material-icons"
                                style="font-size: 42px" data-toggle="tooltip" data-placement="left"
                                title="Ver Farmacia">pageview</i></a>
                        <div>
                            </li> --}}
                            <li class="list-group-item">
                                <h6 class="masthead-subheading">SUCURSAL</h6>
                                <div class="d-flex d-flex justify-content-left pb-2 ml-3">
                                    <a href={{ route ('sucursal.create') }}><i
                                            class=" Medium material-icons " style="font-size: 40px"
                                            data-toggle="tooltip" data-placement="left"
                                            title="Agregar nueva Sucursal">add_box</i></a>
                                    <a href="{{ route ('sucursal.index') }}"><i
                                            class="material-icons" style="font-size: 42px">pageview</i></a>
                                    <div>
                            </li>
                            {{-- <li class="list-group-item"><h6 class="masthead-subheading">PEDIDOS</h6>
                            <div class="d-flex d-flex justify-content-left pb-2 ml-3"> 
                                    <a href=""><i class="material-icons" style="font-size: 40px">pageview</i></a>
                                    <a href=""><i class="material-icons" style="font-size: 40px">assignment</i></a>
                                    
                            </div>
                        
                        </li> --}}
                            <li class="list-group-item">
                                <h6 class="masthead-subheading">RESERVAS</h6>
                                <div class="d-flex d-flex justify-content-left pb-2 ml-3">
                                    <a href=""><i class="material-icons" style="font-size: 40px">pageview</i></a>
                                    <a href=""><i class="material-icons" style="font-size: 40px">assignment</i></a>
                                </div>

                            </li>
                            {{-- <li class="list-group-item"><h6 class="masthead-subheading">Cargar Stock MEDICAMENTOS</h6>
                            <div class="d-flex d-flex justify-content-left pb-2 ml-3"> 
                            <a href=""><i class="material-icons" style="font-size: 40px">pageview</i></a>
                                    <a href=""><i class="material-icons" style="font-size: 40px">add_box</i></a> 
                                    
                            </div>
                        </li> --}}
                            {{-- <li class="list-group-item">
                                <h6 class="masthead-subheading">OBRA SOCIAL</h6>
                                <div class="d-flex d-flex justify-content-left pb-2 ml-3">
                                    <a href="{{ route('obrasocial.index') }}"><i
                                            class="material-icons" style="font-size: 40px">pageview</i></a>
                                    <a href="{{ route('obrasocialfarmacia') }}"><i
                                            class="material-icons" style="font-size: 40px">add_box</i></a>

                                </div>

                            </li> --}}
                            <li class="list-group-item">
                                <h6 class="masthead-subheading">CONTACTAR AL ADMINISTRADOR</h6>
                                <div class="d-flex d-flex justify-content-left pb-2 ml-3">
                                    <a href="{{route('contactarAdmin') }}"><i class="material-icons" title="Enviar email al administrador" style="font-size: 40px">email</i></a>
                                </div>
                            </li>

                    </ul>


            </div>
            <div class="col-lg-8 col-12">
                <!-- para mostrar los alert -->
                @if(session()->has('estado_create'))
                    <div class="alert alert-primary alert-dismissible fade show focus" role="alert">
                        <h5 class="alert-heading pb-4">Registro Exitoso</h5>
                        <strong>{{ session()->get('estado_create') }}</strong>
                        <br>
                        <hr>
                        <p class="text-right">Equipo TuBotiquín</p>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @elseif(session()->has('estado_update'))
                    <div class="alert alert-primary alert-dismissible fade show focus" role="alert">
                        <h5 class="alert-heading pb-4">Actualización Exitosa</h5>
                        <strong>{{ session()->get('estado_update') }}</strong>
                        <br>
                        <hr>
                        <p class="text-right">Equipo TuBotiquín</p>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @elseif(session()->has('estado_delete'))
                    <div class="alert alert-primary alert-dismissible fade show focus" role="alert">
                        <h5 class="alert-heading pb-4">Borrado Exitoso</h5>
                        <strong>{{ session()->get('estado_delete') }}</strong>
                        <br>
                        <hr>
                        <p class="text-right">Equipo TuBotiquín</p>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @elseif(session()->has('mensajeEnviado')) 
                        <div class="alert alert-primary alert-dismissible fade show focus" role="alert">
                            <h5 class="alert-heading pb-4">Mensaje envido con exito</h5>
                            <strong>{{ session()->get('mensajeEnviado') }}</strong>
                            <br>
                            <hr>
                            <p class="text-right">Equipo TuBotiquín</p>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>           
                @endif
                @yield('opcionesFarmaceutico')
            </div>
            @endcan
        </div>
    </div>
</div>
@endsection

<!--</div> -->

<!-- #5AB998
