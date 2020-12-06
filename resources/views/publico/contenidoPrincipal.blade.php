@extends('welcome')
@section('titulo','Home')

@section('contenido')

            <!-- Section of  alert mail contac send -->
            @if(session()->has('mensajeEnviado'))
                <div class="container">
                    <div class="row">
                        <div class="col-12 mx-auto">
                            <div class="text-left alert alert-success alert-dismissible fade show" role="alert">
                                <p class="font-weight-bold">{{ session()->get('mensajeEnviado') }}</p> 
                                <strong><p class="text-right">Equipo TuBotiquín</p></strong>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        </div>
                    </div>    
                </div>        
            @endif
                        <!-- para determinar el estado de la sesion -->
            @if(session()->has('estado'))
            <div class="alert alert-success alert-dismissible fade show focus" role="alert">
                <strong>{{ session()->get('estado') }}</strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            @endif
            
            <div class="container">
                <h2 class="page-section-heading text-center text-uppercase text-secondary mb-0">De turno hoy</h2>
                <h4 class="text-secondary text-center my-2 "><ins><?php echo date('d-m-Y') ?> </ins></h4>
                <p class="lead text-center my-2">Farmacias que se encuentran de turno el día de hoy</p>
                <?php $hora = number_format(date('H') ); ?>
                <div class="row">
                    <div class="col-4  rounded text-center mx-auto">
                        <div class="d-flex d-flex justify-content-middle justify-content-center">
                            @if( $hora >= 7 and $hora <=20 )
                                <i class="material-icons px-1"> wb_sunny</i> 
                            @else
                                <i class="material-icons px-1"> brightness_2</i>
                           @endif
                             <span class="ml-2 px-1">Temperatura:</span>
                             <span class="ml-2 px-1">{{ $hora }}º máx</span>
                             <span class="ml-2 px-1">{{ $mint }}º min</span>
                        </div>
                    </div>
                </div> 
                <br>
            </div>

            <!-- No hay sucursales cargadas -->
            <div class="container">
                <div class="row ">
                    @if(count($sucursalesTurno) < 1)
                        
                        <div class="col-12">
                            <div class="p-3 mb-2 bg-warning rounded shadow text-dark text-center mx-auto">
                                <h6 class="mb-2">
                                    No existen Farmacias de turnos para el día <ins><?php echo date('d-m-Y') ?> </ins> registradas en la plataforma.
                                </h6>   
                                <br>        
                                <p>Disculpe las Molestias. <strong>Equipo tuBotiquín</strong></p>
                            </div>        
                        </div>
                </div>
            </div> <!-- Cierre no hay cargadas --> 

                    @else
                    <!-- Hay sucursales cargadas -->
            <div class="container">   
                <div class="row">

                        <!-- Hay una sola de turno -->
                        @if(count($sucursalesTurno) == 1)
                              
                                <div class="col-12 mt-4">
                                     <div class="shadow bg-white">
                                            <div class="col-12 bg-encabezado mb-3 p-4">
                                            </div>
                                            <div class="row">
                                                <div class="col-8 my-auto text-center">
                                                    <h2 class="card-title"><?php echo strtoupper($sucursalesTurno[0]->getFarmacia->nombre_farmacia ) ?></h2>
                                                    <p> <?php echo $sucursalesTurno[0]->getFarmacia->descripcion_farmacia ?> </p>
                                                </div>     
                                         
                                                <div class="col-md-3 col-12">
                                                    <div class="d-flex d-flex justify-content-center">
                                                        <img class="card-img-top shadow rounded img-fluid" src="{{URL::to('/')}}{{$sucursalesTurno[0]->getFarmacia->img_farmacia }}"
                                                            alt="{{ $sucursalesTurno[0]->getFarmacia->nombre_farmacia }}"  width="150" height="150">
                                                        <hr>
                                                    </div>
                                                </div>       
                                        </div>       
                                        <div class="card-body">
                                                <ul class="list-group list-group-flush">

                                                    <li class="list-group-item">
                                                        <div class="row">
                                                            <div class="col-1"><i class="material-icons">location_on</i></div>
                                                            <div class="col-10"><span class="font-weight-bold text-secondary">{{ $sucursalesTurno[0]->direccion_sucursal }}</span></div>
                                                        </div>
                                                    </li>                           
                                        
                                                    <li class="list-group-item">
                                                        <div class="row">
                                                            <div class="col-1"><i class="material-icons">mail</i></div>
                                                            <div class="col-10"><span class="font-weight-bold text-secondary">{{ $sucursalesTurno[0]->email_sucursal }} </span></div>
                                                        </div>
                                                    </li>

                                                    <li class="list-group-item">
                                                        <div class="row">
                                                            <div class="col-1"><i class="material-icons">local_phone</i></div>
                                                            <div class="col-10"><span class="font-weight-bold text-secondary">{{ $sucursal->telefono_fijo }} </span></div>
                                                        </div>
                                                    </li>   


                                                    @if($sucursal->telefono_movil != "")
                                                        <li class="list-group-item">
                                                            <div class="row">
                                                                <div class="col-1">
                                                                    <i class="fab fa-whatsapp "  style="font-size:25px"></i>
                                                                </div>
                                                                <div class="col-10">
                                                                    <span class="font-weight-bold text-secondary">
                                                                        <a target="_blank"  href="https://api.whatsapp.com/send?phone={{ $sucursalesTurno[0]->telefono_movil }}&text=Hola,%20¿ puedo hacerte una consulta?">Consultanos!</a>   
                                                                    </span>
                                                                </div>
                                                            </div>
                                                        </li>
                                                        <li class="list-group-item" ></li>

                                                    @else
                                                        <li class="list-group-item" style="height:78px"></li>
                                                    @endif
                                                </ul>

                                                <!-- Link  "Ver sucursal" -->
                                                <div class="d-flex d-flex justify-content-center"> 
                                                    <form method="POST" action="{{ route('verSucursalTurnoHoy')}}">
                                                        @csrf  
                                                        <input type="hidden" name="id_sucursal" value= {{ $sucursalesTurno[0]->id_sucursal}}>
                                                        <button type="submit" class="btn btn-link mx-2">
                                                                {{ __('Ver sucursal') }}
                                                        </button>    
                                                    </form>
                                                </div>
                                        </div>
                               </div> 
                        @else
                            <!-- Hay mas de una de turno -->
                            @foreach ($sucursalesTurno as $sucursal)
                              
                                <div class="col-lg-6 col-12 mt-4">
                                     <div class="shadow bg-white ">
                                            <div class="col-12 bg-encabezado mb-3 p-3">
                                            </div>
                                            <div class="row">
                                                <div class="col-md-7 col-12 my-auto text-center">
                                                    <h2 class="card-title"><?php echo strtoupper($sucursal->getFarmacia->nombre_farmacia ) ?></h2>
                                                    @if($sucursal->getFarmacia->descripcion_farmacia == "")
                                                        <p>&nbsp</p> 
                                                    @else
                                                        <p> <?php echo $sucursal->getFarmacia->descripcion_farmacia ?> </p>
                                                    @endif
                                                </div>     
                                         
                                                <div class="col-md-4 col-6">
                                                <img class="card-img-top shadow rounded" src="{{URL::to('/')}}{{$sucursal->getFarmacia->img_farmacia }}"
                                                    alt="{{ $sucursal->getFarmacia->nombre_farmacia }}"  width="200" height="150">
                                                
                                            </div>  
                                                 
                                        </div>       
                                        <div class="card-body">
                                             <ul class="list-group list-group-flush">
                                                    <li class="list-group-item">
                                                        <div class="row">
                                                            <div class="col-1"><i class="material-icons">location_on</i></div>
                                                            <div class="col-10"><span class="font-weight-bold text-secondary">{{$sucursal->direccion_sucursal }}</span></div>
                                                        </div>
                                                    </li>                           
                                                    
                                                    <li class="list-group-item">
                                                        <div class="row">
                                                            <div class="col-1"><i class="material-icons">mail</i></div>
                                                            <div class="col-10"><span class="font-weight-bold text-secondary">{{ $sucursal->email_sucursal }} </span></div>
                                                        </div>
                                                    </li>

                                                    <li class="list-group-item">
                                                        <div class="row">
                                                            <div class="col-1"><i class="material-icons">local_phone</i></div>
                                                            <div class="col-10"><span class="font-weight-bold text-secondary">{{ $sucursal->telefono_fijo }} </span></div>
                                                        </div>
                                                    </li>


                                                    @if($sucursal->telefono_movil !=null)
                                                    <li class="list-group-item">
                                                        <div class="row">
                                                            <div class="col-1">
                                                                <i class="fab fa-whatsapp "  style="font-size:25px"></i>
                                                            </div>
                                                            <div class="col-10">
                                                                <span class="font-weight-bold text-secondary">

                                                                    <a target="_blank"  href="https://api.whatsapp.com/send?phone={{ $sucursal->telefono_movil }}&text=Hola,%20¿te puedo hacerte una consulta?">Consultanos!</a>
                                                                </span>
                                                            </div>
                                                        </div>
                                                    </li>
                                                    @else
                                                        <div class="row">
                                                            <div class="col-1">   
                                                                <p>&nbsp</p>  
                                                            </div>
                                                        </div>                                                                              
                                                    
                                                    <li class="list-group-item" ></li>
                                                    
                                                    @endif   
                                                </ul>

                                               <!-- Link  "Ver sucursal" -->
                                               <div class="d-flex d-flex justify-content-center"> 
                                                    <form method="POST" action="{{ route('verSucursalTurnoHoy')}}">
                                                        @csrf  
                                                        <input type="hidden" name="id_sucursal" value= {{ $sucursal->id_sucursal}}>
                                                        <button type="submit" class="btn btn-link mx-2">
                                                                {{ __('Ver sucursal') }}
                                                        </button>    
                                                    </form>
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
                        <a href="{{ route('verTurnosSiguientes') }}" class="btn btn-link">[ Ver más ]</a> 
                    </div>
                </div>
            </div>


            <!-- Próximas de turno -->
            <div class="container pt-4">
                <div class="row">
                    @if(count($arrSucursalesTurnoSiguiente) == 0)
                         
                        <div class="col-12">
                            <div class="p-3 mb-2 bg-warning rounded shadow text-dark text-center mx-auto">
                                <h6 class="mb-2">
                                    No existen Farmacias de turnos para los siguientes días registradas en la plataforma en este momento
                                </h6>   
                                <br>       
                                 <p>Disculpe las Molestias. <strong>Equipo tuBotiquín</strong></p>
                                
                            </div>        
                        </div>
                    
                    @endif

                    <!-- se lista en formato cards todas sucursales -->
                    @foreach($arrSucursalesTurnoSiguiente as $sucursal)
                        <div class="col-lg-4 col-12 p-3 mb-4 mt-4">
                            <div class="shadow bg-white">
                                <div class="col-12 bg-encabezado mb-3 p-3">
                                </div>
                                <div class="d-flex d-flex justify-content-center"> 
                                    <div class="col-6"> 
                                        <img class="card-img-top shadow rounded" src="{{URL::to('/')}}{{$sucursal->getFarmacia->img_farmacia }}"
                                         alt="{{ $sucursal->getFarmacia->nombre_farmacia }}"  width="110" height="120">
                                </div>
                               </div>
                                <div class="card-body">
                                    <h4 class="card-title text-center"><?php echo strtoupper($sucursal->getFarmacia->nombre_farmacia) ?></h4>
                                    <ul class="list-group list-group-flush">                                  
                                        <li class="list-group-item">
                                            <div class="row">
                                                <div class="col-1"><i class="material-icons">location_on</i></div>
                                                <div class="col-10"><span class="font-weight-bold text-secondary">{{$sucursal->direccion_sucursal }}</span></div>
                                            </div>
                                        </li>                           
                                        
                                        <li class="list-group-item">
                                            <div class="row">
                                                <div class="col-1"><i class="material-icons">mail</i></div>
                                                <div class="col-10"><span class="font-weight-bold text-secondary">{{ $sucursal->email_sucursal }} </span></div>
                                            </div>
                                        </li>

                                        <li class="list-group-item">
                                            <div class="row">
                                                <div class="col-1"><i class="material-icons">local_phone</i></div>
                                                <div class="col-10"><span class="font-weight-bold text-secondary">{{ $sucursal->telefono_fijo }} </span></div>
                                            </div>
                                        </li>
                                        @if($sucursal->telefono_movil !=null)
                                        <li class="list-group-item">
                                            <div class="row">
                                                <div class="col-1">
                                                    <i class="fab fa-whatsapp"  style="font-size:25px"></i>
                                                </div>
                                                <div class="col-10">
                                                    <span class="font-weight-bold text-secondary">
                                                        <a target="_blank"  href="https://api.whatsapp.com/send?phone={{ $sucursal->telefono_movil }}&text=Hola,%20¿te puedo hacerte una consulta?">Consultanos!</a>   
                                                    </span>
                                                </div>
                                            </div>
                                        </li>                                      
                                        @else
                                            <div class="row">
                                                <div class="col-1 m-2">   
                                                    <p>&nbsp</p>  
                                                </div>
                                            </div>                                                                              
                                         @endif
                                    </ul> 

                                    <!-- Link  "Ver sucursal" -->
                                    <div class="d-flex d-flex justify-content-center"> 
                                        <form method="POST" action="{{ route('verSucursalTurnoHoy')}}">
                                        @csrf  
                                        <input type="hidden" name="id_sucursal" value= {{ $sucursal->id_sucursal}}>
                                            <button type="submit" class="btn btn-link mx-2">
                                                {{ __('Ver sucursal') }}
                                            </button>    
                                         </form>
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