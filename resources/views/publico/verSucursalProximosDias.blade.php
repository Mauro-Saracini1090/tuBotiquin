@extends('welcome')
@section('titulo','Próximos días')

@section('contenido')
    <div class="container">
        <div class="row">
            <div class="col-12 mx-4 pb-4">
                <h2 class="page-section-heading text-center text-uppercase text-secondary ">turnos</h2>
                <p class="lead text-center my-3">Listado de Farmacias que estarán de turno los próximos días </p>
            </div>
        </div>
        <!-- Search form -->
        <form class="form-inline d-flex d-flex justify-content-center" method="GET" action="{{ route('verTurnosSiguientes') }}">
            <i class="fas fa-search" aria-hidden="true"></i>
            <input class="form-control form-control-sm ml-3 w-75" name="busquedaTurno" type="date" placeholder="Search" aria-label="Search">
            <button type="submit" class="btn btn-primary mx-2">
                {{ __('Buscar') }}
            </button>
            <button id="resetbusqueda" type="reset" class="btn btn-primary">
                {{ __('Limpiar') }}
            </button>
        </form>   
        @if( !(count($arregloSucursalTurnodia)) < 1 ) 
        <div class="row mt-2">
                 @foreach ($arregloSucursalTurnodia as $sucursalDia)       
                            <div class="col-lg-4 col-12  mt-4 my-4">
                                <div class=" shadow bg-white">
                                    <div class="col-12 bg-encabezado mb-3 p-3 text-center">
                                        <h5 class="text-white"> {{  $sucursalDia["diaTurno"] }} </h5>
                                    </div>
                                    <div class="d-flex d-flex justify-content-center mt-3"> 
                                        <div class="col-6"> 
                                            <img class="card-img-top shadow rounded" src="{{URL::to('/')}}{{$sucursalDia["sucursal"]->getFarmacia->img_farmacia }}"
                                            alt="{{ $sucursalDia["sucursal"]->getFarmacia->nombre_farmacia }}"  width="110" height="110">
                                    </div>
                                </div>
                                    <div class="card-body">
                                         
                                        <ul class="list-group list-group-flush">                                  
                                            <li class="list-group-item">
                                                <div class="row">
                                                    <div class="col-1"><i class="material-icons">location_on</i></div>
                                                    <div class="col-10"><span class="font-weight-bold text-secondary">{{ $sucursalDia["sucursal"]->direccion_sucursal  }}</span></div>
                                                </div>
                                            </li>                           
                                            
                                            <li class="list-group-item">
                                                <div class="row">
                                                    <div class="col-1"><i class="material-icons">mail</i></div>
                                                    <div class="col-10"><span class="font-weight-bold text-secondary">{{ $sucursalDia["sucursal"]->email_sucursal }} </span></div>
                                                </div>
                                            </li>
    
                                            <li class="list-group-item">
                                                <div class="row">
                                                    <div class="col-1"><i class="material-icons">local_phone</i></div>
                                                    <div class="col-10"><span class="font-weight-bold text-secondary">{{ $sucursalDia["sucursal"]->telefono_fijo }} </span></div>
                                                </div>
                                            </li>
    
                                            @if($sucursalDia["sucursal"]->telefono_movil !=null)
                                                <li class="list-group-item">
                                                    <div class="row">
                                                        <div class="col-1">
                                                            <i class="fab fa-whatsapp"  style="font-size:25px"></i>
                                                        </div>
                                                        <div class="col-10">
                                                            <span class="font-weight-bold text-secondary">
                                                                <a target="_blank"  href="https://api.whatsapp.com/send?phone={{ $sucursalDia["sucursal"]->telefono_movil }}&text=Hola,%20¿te puedo hacerte una consulta?">Consultanos!</a>   
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
                                            <li class="list-group-item"></li>  
                                        </ul> 

                                        <div class="d-flex d-flex justify-content-center"> 
                                            <form method="POST" action="{{ route('verSucursalTurnoHoy')}}">
                                                @csrf  
                                                <input type="hidden" name="id_sucursal" value= {{ $sucursalDia["sucursal"]->id_sucursal}}>
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
            <div class="d-flex d-flex justify-content-center mt-4"> 
                {{ $arregloSucursalTurnodia->links() }}
            </div> 
            @else    
                <div class="row mt-4">
                    <div class="col-12 text-center">
                        <div class="p-3 mb-2 bg-warning rounded shadow text-dark ">
                            <h6 class="font-weight-bold text-center mb-2">Atención. Ocurrio un error en la búsqueda, intentelo nuevamente mas tarde</h6>
                            <br>
                            <p>Disculpe las Molestias. <strong>Equipo tuBotiquín</strong></p>
                        </div>
                    </div>
                </div>
            @endif    
    </div>
@endsection
@section('zona_js')
    <script>
        $('#resetbusqueda').click(function(){
            history.pushState(null, "", "turnossiguientes");
            location.reload();
        });
        
    </script>
@endsection
