@extends('welcome')
@section('titulo','Farmacias y sucursales')

@section('contenido')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="shadow p-4 mb-5 bg-white rounded"> 
                    <!-- Masthead Subheading-->

                     <div class="row" >
                            <div Class="col-lg-8 col-12" >
                                    <h2 class="page-section-heading text-uppercase text-secondary  m-3">{{ $farmacia->nombre_farmacia }}</h2>
                                    <div class="text m-3 p-3">   
                                        <p>{{ $farmacia->descripcion_farmacia }}<p>
                                    </div>   
                                    </div>
                                    <div Class="col-lg-3 col-12">
                                    <div class="d-flex justify-content-center m-3">
                                            <figure class="figure">
                                                <img src="{{ asset($farmacia->img_farmacia) }}" width="150" alt="Imagen Logo">
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
                                       
                                            <p>{{ $sucursal->descripcion_sucursal}}</p>
                                            <p>Cufe {{ $sucursal->cufe_sucursal}}</p> 
                                            <p>Email: {{$sucursal->email_sucursal }}</p>
                                                          
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

                        <!-- Obra Sociales -->
                        @if( count($arrayObraSociales) >= 0 )
                         <div class="row">
                            <div class="col-12">
                                <h5 class="text-secondary  m-3">Obras Sociales</h5>
                                     <ul class="list-group list-group-flush">
                                @foreach($arrayObraSociales as $obraSocial)
                                        <li class="list-group-item">{{$obraSocial->Nombre_obra_social }}</li>           
                                @endforeach
                                 </ul>
                            </div>
                         </div>
                        @else
                         <div class="row">
                            <div class="col-12">
                                <h5 class="text-secondary  m-3">No hay Obras Sociales cargadas</h5>
                            </div>
                         </div>
                        @endif  
            
                </div>
             </div>
        </div>           

@endsection