@extends('welcome')
@section('titulo','Home Farmaceutico')

@section('contenido')
     <!--<div class="shadow p-3 mb-5 bg-white rounded">  -->
       <div class="py-2 pb-5">
        <div class="container">
                  <div class="row">
                    <div class="col-lg-4 col-12">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item "><h5 class="masthead-subheading">FARMACIA</h5>
                            <div class="d-flex d-flex justify-content-center"> 
                                <a href="{{ route('farmacia.create') }}"> <i class=" Medium material-icons " style="font-size: 40px">add</i></a>
                                <a href="{{ route('verfarmacia') }}"><i class="material-icons" style="font-size: 40px">pageview</i></a>
                                <a href=""><i class="material-icons" style="font-size: 40px">edit</i></a>
                            <div>
                        </li>
                    <li class="list-group-item"><h5 class="masthead-subheading">SUCURSAL</h5>
                        <div class="d-flex d-flex justify-content-center"> 
                                <a href={{ route ('sucursal.create') }}><i class=" Medium material-icons " style="font-size: 40px">add</i></a> 
                                <a href=""><i class="material-icons" style="font-size: 40px">pageview</i></a>
                                <a href=""><i class="material-icons" style="font-size: 40px">edit</i></a>
                        <div>        
                    </li>
                    <li class="list-group-item"><h5 class="masthead-subheading">PEDIDOS</h5>
                        <div class="d-flex d-flex justify-content-center"> 
                                <a href=""><i class="material-icons" style="font-size: 40px">pageview</i></a>
                                <a href=""><i class="material-icons" style="font-size: 40px">assignment</i></a>
                                
                        </div>
                    
                    </li>
                    <li class="list-group-item"><h5 class="masthead-subheading">RESERVAS</h5>
                        <div class="d-flex d-flex justify-content-center"> 
                               <a href=""><i class="material-icons" style="font-size: 40px">pageview</i></a> 
                               <a href=""><i class="material-icons" style="font-size: 40px">assignment</i></a>    
                        </div>
                    
                    </li>
                    <li class="list-group-item"><h5 class="masthead-subheading">MEDICAMENTOS</h5>
                        <div class="d-flex d-flex justify-content-center"> 
                                <a href=""><i class="material-icons" style="font-size: 40px">pageview</i></a>
                                <a href=""><i class="material-icons" style="font-size: 40px">note_add</i></a> 
                                
                        </div>
                    
                    </li>
                     <li class="list-group-item"><h5 class="masthead-subheading">CONTACTAR AL ADMINISTRADOR</h5>
                        <div class="d-flex d-flex justify-content-center">
                             <a href=""><i class="material-icons" style="font-size: 40px">mail_outline</i></a>
                        </div>
                     </li>
                    
                    </ul>

                
                 </div>
                 <div class="col-lg-8 col-12">
                        @yield('opcionesFarmaceutico')
                 </div>
        </div> 
     @endsection             
 
        <!--</div> -->
       
<!-- #5AB998

