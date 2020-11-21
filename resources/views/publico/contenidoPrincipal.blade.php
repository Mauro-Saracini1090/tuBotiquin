@extends('welcome')
@section('titulo','Home')

@section('contenido')
 

            <div class="container">    
                <h2 class="page-section-heading text-center text-uppercase text-secondary mb-0">De turno hoy</h2>
                <h4 class="text-secondary text-center my-2 "><ins><?php echo date('d-m-Y') ?> </ins></h4>
                <p class="lead text-center my-2 pb-4">Farmacias que se encuentran de turno el día de hoy</p>
            </div>

            <!-- No hay sucursales cargadas -->
            <div class="container">
                <div class="row ">
                    @if(count($sucursalesTurno) < 1)
                        <div class="alert alert-warning alert-dismissible fade show focus" role="alert">
                            <strong>No Existen Farmacias de turno Registradas en tuBotiquin en este momento. Disculpe
                                las Molestias. Equipo tuBotiquin</strong>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                </div>
            </div> <!-- Cierre no hay cargadas --> 

                    @else
                    <!-- Hay sucursales cargadas -->
            <div class="container">   
                <div class="row">

                        <!-- Hay una sola de turno -->
                        @if(count($sucursalesTurno) == 1)
                              
                            <div class="col-12">  
                                    <div class="d-flex d-flex justify-content-center"> 
                                        <div class="col-4"> 
                                             <img class="card-img-top" src="{{URL::to('/')}}{{ $sucursalesTurno[0]->getFarmacia->img_farmacia }}"
                                                alt="{{ $sucursalesTurno[0]->getFarmacia->nombre_farmacia }}" width="200">
                                        </div>
                                    </div>    
                                    <div class="card-body mb-2">
                                        <h4 class="card-title text-center"> {{ $sucursalesTurno[0]->getFarmacia->nombre_farmacia }}</h4>
                                            <p>Direccion:{{ $sucursalesTurno[0]->direccion_sucursal }} </p>
                                            
                                            <p>Email:{{ $sucursalesTurno[0]->email_sucursal }} </p>
                                            <p>Telefono:{{ $sucursalesTurno[0]->telefono_sucursal }} </p>
                                            
                                            <div class="d-flex d-flex justify-content-center"> 
                                                <a href="#" class="btn btn-primary btn-sm">Ver sucursal</a>
                                            </div>    
                                        </div>
                                    </div>    
                                </div>
                           </div>
                        @else
                            <!-- Hay mas de una de turno -->
                            @foreach ($sucursalesTurno as $sucursal)
                              
                                <div class="col-md-6 col-12 ">
                                     <div class="shadow  p-3 mb-4  bg-white rounded">
                                                <div class="col-6">

                                                </div>     
                                        <div class="d-flex d-flex justify-content-end"> 
                                                <h2 class="card-title text-left">{{ $sucursal->getFarmacia->nombre_farmacia }}</h2>
                                                <div class="col-6">
                                                <img class="card-img-top shadow img-rounded" src="{{URL::to('/')}}{{$sucursal->getFarmacia->img_farmacia }}"
                                                    alt="{{ $sucursal->getFarmacia->nombre_farmacia }}"  width="200" >
                                                    <hr>
                                                </div>   
                                        </div>       
                                        <div class="card-body">
                                                
                                                <p class="text-secondary">Dirección: {{ $sucursal->direccion_sucursal }} </p>
                                                <p>Email: {{ $sucursal->email_sucursal }} </p>
                                                <p>Telefono: {{ $sucursal->telefono_sucursal }} </p> 
                                                <hr>   
                                                <div class="d-flex d-flex justify-content-center"> 
                                                    <a href="#" class="btn btn-primary btn-sm">Ver sucursal</a>
                                                </div>
                                        </div>
                                    </div>
                               </div> 
                            @endforeach  
                        @endif  
                    @endif
                </div> 
           
            </div> <!-- cierre container card turnos hoy -->  
                
            <div class="container pt-4">
            <hr>
                <div class="row pt-4">
                 
                    <div class="col-md-12 mt-4">
                    
                        <h2 class="page-section-heading text-center text-uppercase text-secondary mb-0">Próximas de turno</h2>
                        <p class="lead text-center my-2 ">Farmacias que se encontrarán de turnos los próximos días
                        <button type="button" class="btn btn-link">[ Ver más ]</button></p>
                    </div>
                </div>
            </div>


            <!-- Próximas de turno -->
            <div class="container pt-4">
                <div class="row">
                    @if(count($arrSucursalesTurnoSiguiente) == 0)
                        <div class="alert alert-warning alert-dismissible fade show focus" role="alert">
                                <strong>No Existen Farmacias de turno para dias siguientes Registradas en tuBotiquin en este momento. Disculpe
                                    las Molestias. Equipo tuBotiquin</strong>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                        </div>
                    @endif
                    @foreach($arrSucursalesTurnoSiguiente as $sucursal)
                        <div class="col-md-4 col-12">
                            <div class="p-3 mb-4 shadow bg-white rounded">
                                 <div class="d-flex d-flex justify-content-center"> 
                                    <div class="col-6"> 
                                        <img class="card-img-top shadow img-rounded" src="{{URL::to('/')}}{{$sucursal->getFarmacia->img_farmacia }}"
                                         alt="{{ $sucursal->getFarmacia->nombre_farmacia }}" >
                                  </div>
                               </div>
                                <div class="card-body">
                                    <h4 class="card-title text-center">{{ $sucursal->getFarmacia->nombre_farmacia }}</h4>
                                    <p>Direccion:  {{$sucursal->direccion_sucursal }}</p>
                                    
                                    <p>Email: {{ $sucursal->email_sucursal }} </p>
                                    <p>Telefono: {{ $sucursal->telefono_sucursal }} </p>
                                    <hr>  
                                    <div class="d-flex d-flex justify-content-center"> 
                                        <a href="#" class="btn btn-primary btn-sm">Ver sucursal</a>
                                    </div>    
                                </div>

                            </div>
                        </div>    
                    @endforeach    
                </div>
                <hr>
            </div><!-- Cierre container proximas de turno -->
      
 </div> <!--Cierre Container principal -->
 
@endsection