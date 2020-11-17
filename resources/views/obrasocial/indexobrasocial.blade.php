@extends('farmaceutico.indexFarmaceutico')
@section('titulo','Farmacias y sucursales')

@section('opcionesFarmaceutico')
    <div class="container">
            <div class="col-12 ">
                <div class="shadow bg-white rounded"> 
                    <div class="col-md-12 p-3 mb-5 fondo text-left">
                        @foreach ($arrayObraSocial as $obrasocial)
                            <h4 class="">{{ $obrasocial->Nombre_obra_social }}</h4>
                            <p> {{ $obrasocial->Telefono_obra_Social  }}</p> 
                            <hr>
                        @endforeach
                    </div>
                </div>             
            
        </div>
    </div>         
@endsection