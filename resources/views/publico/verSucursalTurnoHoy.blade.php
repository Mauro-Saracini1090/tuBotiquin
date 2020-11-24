@extends('welcome')
@section('titulo','Farmacia de Turno')

@section('contenido')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="  shadow bg-white"> 
                    <!-- Masthead Subheading-->
                     <div class="col-12 bg-encabezado mb-3 p-3">
                            <h2 class=" text-center text-white"> </h2>
                    </div>
                    @if( !(empty($farmacia)  && empty($sucursal)))
                     <div class="row" > 

                            <div Class="col-lg-8 col-12 text-center" >
                                     <div class="text pt-4 mt-4"> 
                                        <h2 class="page-section-heading text-uppercase text-secondary py-auto"><?php echo strtoupper( $farmacia->nombre_farmacia) ?></h2>
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
                    <hr> 
                        <!-- Sucursal -->
                        <h4 class="text-secondary  m-3">Sucursal</h4>
                               
                                <div class="row">
 
                                    <div Class="col-lg-7 col-12 " >
                                        <div class="text ml-5 p-1"> 
                                             <ul class="list-group list-group-flush">
                                                <li class="list-group-item"><i class="material-icons">access_time</i> <span class="font-weight-bold text-secondary"> <?php echo $sucursal->descripcion_sucursal ?></li>
                                                <li class="list-group-item"><i class="material-icons">location_on</i> <span class="font-weight-bold text-secondary">{{$sucursal->direccion_sucursal }}</span></li>
                                                <li class="list-group-item"><i class="material-icons">mail</i> <span class="font-weight-bold text-secondary">{{ $sucursal->email_sucursal }} </span></li>
                                                <li class="list-group-item"><i class="material-icons">local_phone</i> <span class="font-weight-bold text-secondary">{{ $sucursal->telefono_sucursal }} </span></li>
                                                <li class="list-group-item"></li>
                                            </ul> 
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

                          @if( !(count($arrayObraSociales)) < 1 )
                            <!-- Obra Sociales -->
                            <div class="row">
                                <div class="col-12">
                                    <h4 class="text-secondary  m-3">Obras sociales</h4>
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
                                 <h4 class="text-secondary  m-3">Obras sociales</h4>
                                    <div class="p-3 mb-2 bg-warning text-dark">
                                        <h6 class="font-weight-bold text-center">Esta Sucursal Farmacuetica no posee Obras Sosciales cargadas</h6>
                                    </div>
                                </div>
                        </div>
                        @endif  
                     
                    <!-- Error, farmacia o sucursal con borrado logico -->    
                    @else
                        <div class="row">
                                <div class="col-12">
                               
                                    <div class="p-3 mb-2 bg-warning text-dark ">
                                        <h6 class="font-weight-bold text-center">Atención. Ocurrio un error en la búsqueda, intentelo nuevamente mas tarde</h6>
                                    </div>
                                </div>
                        </div>
                    @endif
                </div>
             </div>
        </div>         
@endsection
