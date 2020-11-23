@extends('welcome')
@section('titulo','Farmacias y sucursales')

@section('contenido')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="p-4 mb-5  shadow bg-white rounded"> 
                    <!-- Masthead Subheading-->
                    @if( !(empty($farmacia)  && empty($arraySucursales)))
                     <div class="row" >
                            <div Class="col-lg-8 col-12 mt-4">
                                    <h2 class="page-section-heading text-uppercase text-secondary text-center"><?php echo strtoupper($farmacia->nombre_farmacia ) ?></h2>
                                    <div class="text  text-center">   
                                        <p> <?php echo $farmacia->descripcion_farmacia ?><p>
                                    </div>   
                                    </div>
                                    <div Class="col-lg-3 col-12">
                                    <div class="d-flex justify-content-center m-3">
                                            <figure class="figure">
                                                <img class="shadow img-rounded" src="{{ asset($farmacia->img_farmacia) }}" width="150" alt="Imagen Logo">
                                            </figure>
                                    </div>
                            </div>
                      </div>

                        <!-- Sucursales -->
                        <!-- Mostrar primero la sede central -->
                        @if(count($arraySucursales) > 0 )
                            <h4 class="text-secondary  m-3">Nuestras sucursales</h4>
                            <hr>
                        @else
                            <h4 class="text-secondary  m-3">Nuestra sucursal</h4>
                            <hr>    
                        @endif       
                        @foreach ($arraySucursales as  $sucursal)
                           
                            @if ($sucursal->habilitado == 1)
                                <div class="row">
                                    <div Class="col-lg-7 col-12 " >
                                        <div class="text ml-5 p-1"> 
                                       
                                            <p><?php echo $sucursal->descripcion_sucursal ?></p>
                                            <p>Email: <span class="font-weight-bold text-secondary">{{$sucursal->email_sucursal }} </span></p>
                                            <p>Teléfono: <span class="font-weight-bold text-secondary">{{ $sucursal->telefono_sucursal }} </span></p> 
                                            <p>Dirección: <span class="font-weight-bold text-secondary">{{$sucursal->direccion_sucursal }} </span></p> 

                                        </div>
                                    </div>  
                                
                                    <div Class="col-lg-5 col-12">
                                        <div class="d-flex d-flex justify-content-center"> 
                                            <div class="mapa">
                                                <iframe class="iframe border" height="200"></iframe>
                                           </div>
                                        </div>   
                                    </div>
                                    <div class="col-12">
                                        <hr>    
                                    </div>
                                </div>
                            @endif  
                                 
                        @endforeach

                         @if( !(count($arrayObraSociales)) < 1 )
                            <!-- Obra Sociales -->
                            <div class="row">
                                <div class="col-12">
                                    <h5 class="text-secondary  m-3">OBRAS SOCIALES</h5>
                                        <div class="p-4">
                                        <ul class="list-inline">
                                        @foreach($arrayObraSociales as $obraSocial)
                                            <li class="list-inline-item m-2"> {{$obraSocial->Nombre_obra_social }} </li> 
                                        @endforeach
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        @else  
                             <div class="row">
                                <div class="col-12">
                                    <div class="p-3 mb-2 bg-warning text-dark">
                                        <h6 class="font-weight-bold text-center">Esta Sucursal Farmacuetica no posee Obras Sosciales cargadas</h6>
                                    </div>
                                </div>
                        </div>
                        @endif 
                    @else
                        <div class="row">
                                <div class="col-12">
                                    <div class="p-3 mb-2 bg-warning rounded text-dark ">
                                        <h6 class="font-weight-bold text-center">Atención. Ocurrio un error en la búsqueda, intentelo nuevamente mas tarde</h6>
                                    </div>
                                </div>
                        </div>

                    @endif     
                </div>
             </div>
        </div>           
@endsection