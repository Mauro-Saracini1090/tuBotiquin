@extends('welcome')
@section('titulo','Home Farmaceutico')

@section('contenido')
     <!--<div class="shadow p-3 mb-5 bg-white rounded">  -->
    <div class="py-2 pb-5">
        <div class="container">
        
            <div class="row">
                <div class="col-12">
                    <h4 class="masthead-subheading">Opciones</h4>
                </div>
                 <div class="col-lg-3 col-12">
                     @can('esFarmaceutico')
                        
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item "><h6 class="masthead-subheading">FARMACIA</h6>
                                <div class="d-flex d-flex justify-content-left pb-2 ml-3"> 
                                    <a href="{{ route('farmacia.create') }}"> <i class=" Medium material-icons " style="font-size: 40px" data-toggle="tooltip" data-placement="left" title="Agregar nueva Farmacia">add_box</i></a>
                                    <a href="{{ route('verfarmacia') }}"><i class="material-icons" style="font-size: 42px" data-toggle="tooltip" data-placement="left" title="Ver Farmacia">pageview</i></a>
                                    <!--<a href=""><i class="material-icons" style="font-size: 40px" data-toggle="tooltip" data-placement="left"  title="Editar Farmacia">edit</i></a>-->

                                <div>
                            </li>
                        <li class="list-group-item"><h6 class="masthead-subheading">SUCURSAL</h6>
                            <div class="d-flex d-flex justify-content-left pb-2 ml-3"> 
                                    <a href={{ route ('sucursal.create') }}><i class=" Medium material-icons " style="font-size: 40px" data-toggle="tooltip" data-placement="left" title="Agregar nueva Sucursal">add_box</i></a> 
                                    <a href=""><i class="material-icons" style="font-size: 42px">pageview</i></a>
                                    <!--<a href=""><i class="material-icons" style="font-size: 40px">edit</i></a>-->
                            <div>        
                        </li>
                        <li class="list-group-item"><h6 class="masthead-subheading">PEDIDOS</h6>
                            <div class="d-flex d-flex justify-content-left pb-2 ml-3"> 
                                    <a href=""><i class="material-icons" style="font-size: 40px">pageview</i></a>
                                    <a href=""><i class="material-icons" style="font-size: 40px">assignment</i></a>
                                    
                            </div>
                        
                        </li>
                        <li class="list-group-item"><h6 class="masthead-subheading">RESERVAS</h6>
                            <div class="d-flex d-flex justify-content-left pb-2 ml-3"> 
                                <a href=""><i class="material-icons" style="font-size: 40px">pageview</i></a> 
                                <a href=""><i class="material-icons" style="font-size: 40px">assignment</i></a>    
                            </div>
                        
                        </li>
                        <li class="list-group-item"><h6 class="masthead-subheading">MEDICAMENTOS</h6>
                            <div class="d-flex d-flex justify-content-left pb-2 ml-3"> 
                                    <a href=""><i class="material-icons" style="font-size: 40px">pageview</i></a>
                                    <a href=""><i class="material-icons" style="font-size: 40px">add_box</i></a> 
                                    
                            </div>
                            <li class="list-group-item"><h6 class="masthead-subheading">Obra Social</h6>
                            <div class="d-flex d-flex justify-content-left pb-2 ml-3"> 
                                    <a href="{{ route('obrasocial.index')}}"><i class="material-icons" style="font-size: 40px">pageview</i></a>
                                    <a href="{{ route('obrasocialfarmacia')}}"><i class="material-icons" style="font-size: 40px">add_box</i></a> 
                                    
                            </div>
                        
                        </li>
                        <li class="list-group-item"><h6 class="masthead-subheading">CONTACTAR AL ADMINISTRADOR</h6>
                            <div class="d-flex d-flex justify-content-left pb-2 ml-3">
                                <a href=""><i class="material-icons" style="font-size: 40px">email</i></a>
                            </div>
                        </li>
                        
                        </ul>

                    
                    </div>
                    <div class="col-lg-8 col-12">
                            @yield('opcionesFarmaceutico')
                    </div>        
                 @endcan
            </div>        
        </div> 
     @endsection             
 
        <!--</div> -->
       
<!-- #5AB998

