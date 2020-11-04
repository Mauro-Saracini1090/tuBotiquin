@extends('welcome')
@section('titulo','Home Farmaceutico')

@section('contenido')
     <!--<div class="shadow p-3 mb-5 bg-white rounded">  -->
       <div class="py-2 pb-5">
        <div class="container">
                  <div class="row">
                    <div class="col-md-4  col-12">
                        <div class="shadow p-3 mb-5 bg-white rounded">
                            <img class="card-img-top"  width="150" height="150" src="../public/assets/img/imgFarmaceutico/cargar.svg" alt="Card image cap">
                                <div class="card-body">
                                    <h5 class="card-title">Farmacia</h5>
                                    <p class="card-text"></p> 
                                    <hr>
                                    <a href="{{ route('farmacia.create') }}" class="btn btn-primary btn-sm">Cargar</a>
                                    <a href="" class="btn btn-primary btn-sm">Ver</a>
                                </div>
                        </div>
                    </div>
                    <div class="col-md-4   col-12">
                        <div class="shadow p-3 mb-5 bg-white rounded">
                            <img class="card-img-top" width="150" height="150" src="../public/assets/img/imgFarmaceutico/sucursales.svg" alt="Card image cap">
                                <div class="card-body">
                                    <h5 class="card-title">Sucursal</h5>
                                    <p class="card-text"></p> 
                                    <hr>
                                    <a href={{ route ('sucursal.create') }} class="btn btn-primary btn-sm">cargar</a>
                                    <a href="" class="btn btn-primary btn-sm">Ver</a>
                                </div>
                        </div>   
                    </div>
                    <div class="col-md-4   col-12">
                        <div class="shadow p-3 mb-5 bg-white rounded">
                            <img class="card-img-top" width="150" height="150" src="../public/assets/img/imgFarmaceutico/reserva.svg"  alt="Card image cap" style="">
                                <div class="card-body">
                                    <h5 class="card-title">Pedidos</h5>
                                    <p class="card-text"></p>
                                    <hr>
                                    <a href="#" class="btn btn-primary btn-sm">Ir</a>
                                </div>
                        </div>    
                    </div>
                  </div>
                 
                  <div class="row">
                    <div class="col-md-4   col-12">
                        <div class="shadow p-3 mb-5 bg-white rounded">
                            <img class="card-img-top" width="150" height="150" src="../public/assets/img/imgFarmaceutico/reserva.svg"  alt="Card image cap">
                                <div class="card-body">
                                    <h5 class="card-title">Reservas</h5>
                                    <p class="card-text"></p> 
                                    <hr>
                                    <a href="#" class="btn btn-primary btn-sm">Ir</a>
                                </div>
                        </div>
                    </div>
                    <div class="col-md-4   col-12">
                        <div class="shadow p-3 mb-5 bg-white rounded">
                            <img class="card-img-top" width="150" height="150" src="../public/assets/img/imgFarmaceutico/stock.svg" alt="Card image cap">
                                <div class="card-body">
                                    <h5 class="card-title"> Stock</h5>
                                    <p class="card-text"></p> 
                                    <hr>
                                    <a href="#" class="btn btn-primary btn-sm">cargar</a>
                                </div>
                        </div>   
                    </div>
                    <div class="col-md-4   col-12">
                        <div class="shadow p-3 mb-5 bg-white rounded">
                            <img class="card-img-top" width="150" height="150" src="../public/assets/img/imgFarmaceutico/contactar.svg" alt="Card image cap" style="">
                                <div class="card-body">
                                    <h5 class="card-title">Contactar al Administardor</h5>
                                    <p class="card-text"></p>
                                    <hr>
                                    <a href="#" class="btn btn-primary btn-sm">Ir</a>
                                </div>          
                        </div>    
                    </div>
                  </div> 
        <!--</div> -->
    </div>

@endsection
<!-- #5AB998

