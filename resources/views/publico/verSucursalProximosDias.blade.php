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
        <div class="row mt-2">
                 @foreach ($arregloSucursalTurnodia as $sucursalDia)       
                            <div class="col-lg-4 col-12  mt-4 my-4">
                                <div class=" shadow bg-white">
                                    <div class="col-12 bg-encabezado mb-3 p-3 text-center">
                                        <h5 class="text-white"> {{  $sucursalDia["diaTurno"] }} </h5>
                                    </div>
                                    <div class="d-flex d-flex justify-content-center mt-3"> 
                                        <div class="col-6"> 
                                            <img class="card-img-top shadow img-rounded" src="{{URL::to('/')}}{{$sucursalDia["sucursal"]->getFarmacia->img_farmacia }}"
                                            alt="{{ $sucursalDia["sucursal"]->getFarmacia->nombre_farmacia }}"  width="110" height="110">
                                    </div>
                                </div>
                                    <div class="card-body">
                                        <h4 class="card-title text-center"><?php echo strtoupper($sucursalDia["sucursal"]->getFarmacia->nombre_farmacia) ?></h4>
                                        <ul class="list-group list-group-flush">
                                            <li class="list-group-item"><i class="material-icons">location_on</i>  <span class="font-weight-bold text-secondary"> {{$sucursalDia["sucursal"]->direccion_sucursal }}</span></li>
                                            <li class="list-group-item"><i class="material-icons">mail</i>  <span class="font-weight-bold text-secondary"> {{ $sucursalDia["sucursal"]->email_sucursal }} </span></li>
                                            <li class="list-group-item"><i class="material-icons">local_phone</i>  <span class="font-weight-bold text-secondary"> {{ $sucursalDia["sucursal"]->telefono_sucursal }} </span></li>
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
    </div>
@endsection

